<?php

namespace App\Http\Controllers;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Telegram\Bot\Api;
use App\Models\UserDropPreference;

class TelegramBotController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        // Inicializa a classe Api com o token do .env
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function handle(Request $request)
    {
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();

        if ($message) {
            $chatId = $message->getChat()->getId();
            $text = $message->getText();

            // Check if the user has already run the /start command before proceeding
            $userHasStarted = DB::table('user_drop_preferences')->where('chat_id', $chatId)->exists();

            // /start command to initiate interaction with the bot
            if ($text == '/start') {
                // Mark the user as having started the bot
                if (!$userHasStarted) {
                    DB::table('user_drop_preferences')->insert([
                        'chat_id' => $chatId,
                        'drop_ids' => '', // Initially no drops
                    ]);
                }

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Welcome! Please send a list of drop IDs you want to receive notifications for, separated by commas, example., "111,333,555".',
                ]);
            }
            // Only allow further interactions if the user has already started the bot
            elseif ($userHasStarted) {
                // /listdrops command to list followed drops
                if ($text == '/listdrops') {
                    $this->listDrops($chatId);
                }
                // /delete command to remove followed drops
                elseif (strpos($text, '/delete') === 0) {
                    $dropIdsToDelete = trim(str_replace('/delete', '', $text));
                    $this->deleteDropPreferences($chatId, $dropIdsToDelete);
                }
                // Check if the message contains valid drop IDs
                elseif ($this->isValidDropList($text)) {
                    // Save the user's drop preferences
                    $this->saveDropPreferences($chatId, $text);

                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => "You will receive notifications for these drops: " . $text,
                    ]);
                } else {
                    // Default message for invalid commands
                    Telegram::sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Please start the bot by sending the /start command. Use /listdrops to see the drops you are following or /delete to remove drops.',
                    ]);
                }
            }
            // If the user tries to interact without having done /start
            else {
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Please start by sending the /start command to initiate.',
                ]);
            }
        }

        return response('Ok', 200);
    }

    // Check if the message is a valid list of drop IDs
    private function isValidDropList($text)
    {
        return preg_match('/^(\d+,)*\d+$/', $text);
    }

    // Save user preferences in the database
    private function saveDropPreferences($chatId, $newDropIds)
    {
        $existingEntry = DB::table('user_drop_preferences')->where('chat_id', $chatId)->first();

        if ($existingEntry) {
            $existingDropIds = explode(',', $existingEntry->drop_ids);
            $newDropIdsArray = explode(',', $newDropIds);
            $combinedDropIds = array_unique(array_merge($existingDropIds, $newDropIdsArray));

            DB::table('user_drop_preferences')->where('chat_id', $chatId)->update([
                'drop_ids' => implode(',', $combinedDropIds),
            ]);
        } else {
            DB::table('user_drop_preferences')->insert([
                'chat_id' => $chatId,
                'drop_ids' => $newDropIds,
            ]);
        }
    }

    // List the drops the user is following
    private function listDrops($chatId)
    {
        $entry = DB::table('user_drop_preferences')->where('chat_id', $chatId)->first();

        if ($entry && !empty($entry->drop_ids)) {
            $dropIds = $entry->drop_ids;
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => "You are following these drops: " . $dropIds,
            ]);
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'You are not following any drops at the moment.',
            ]);
        }
    }

    // Remove drops from user preferences
    private function deleteDropPreferences($chatId, $dropIdsToDelete)
    {
        $existingEntry = DB::table('user_drop_preferences')->where('chat_id', $chatId)->first();

        if ($existingEntry) {
            $existingDropIds = explode(',', $existingEntry->drop_ids);
            $dropIdsToDeleteArray = explode(',', $dropIdsToDelete);

            // Remove the drop_ids to be deleted
            $remainingDropIds = array_diff($existingDropIds, $dropIdsToDeleteArray);

            if (empty($remainingDropIds)) {
                // If all drops are removed, delete the record
                DB::table('user_drop_preferences')->where('chat_id', $chatId)->delete();
                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'All drops have been removed from your preferences.',
                ]);
            } else {
                // Update the record with remaining drops
                DB::table('user_drop_preferences')->where('chat_id', $chatId)->update([
                    'drop_ids' => implode(',', $remainingDropIds),
                ]);

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'The drops have been successfully removed: ' . implode(',', $dropIdsToDeleteArray),
                ]);
            }
        } else {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => 'You do not have any drops associated to delete.',
            ]);
        }
    }

    public function showSendMessageForm()
    {
        // Contagem total de chat_ids únicos
        $connectedCount = UserDropPreference::distinct('chat_id')->count('chat_id');

        $chatIds = UserDropPreference::pluck('chat_id', 'id');

        return view('panel.send-message', compact('chatIds', 'connectedCount'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:4096',
        ]);

        $message = $request->message;
        $chatId = $request->input('chat_id');

        try {
            if ($chatId === 'all') {
                // Enviar mensagem para todos os chat_ids
                $chatIds = DB::table('user_drop_preferences')->pluck('chat_id');

                foreach ($chatIds as $id) {
                    $this->telegram->sendMessage([
                        'chat_id' => $id,
                        'text' => $message,
                    ]);
                }
            } else {
                // Enviar mensagem para um chat_id específico
                $this->telegram->sendMessage([
                    'chat_id' => $chatId,
                    'text' => $message,
                ]);
            }

            return redirect()->back()->with('success', 'Message sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }
}
