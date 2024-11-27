<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drop;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserController extends Controller
{

    //-----------------------controller Profile
    public function profile(User $user)
    {
        $user = Auth::user();
        return view('profile.partials.user-profile-settings', ['user' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telegram' => 'required|string|unique:users,telegram,' . $user->id,
        ]);

        try {
            if ($request->hasFile('profile_image')) {
                // Caminho para a pasta profile_images dentro de public_html
                $profileImagesPath = base_path('../public_html/profile_images');

                // Delete old profile image if exists
                if ($user->profile_image && file_exists($profileImagesPath . '/' . $user->profile_image)) {
                    unlink($profileImagesPath . '/' . $user->profile_image);
                }

                // Armazenar nova imagem de perfil
                $profileImageName = $user->id . '_' . time() . '.' . $request->profile_image->getClientOriginalExtension();
                $request->profile_image->move($profileImagesPath, $profileImageName);

                // Atualizar imagem de perfil do usuário
                $user->profile_image = $profileImageName;
            }

            // Atualizar o nome de usuário do Telegram
            $user->telegram = $request->telegram;
            $user->save();

            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred when updating the profile. Please try again.');
        }
    }




    public function accountSettings(User $user)
    {
        return view('profile.partials.user-account-settings', ['user' => $user]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current' => 'required',
            'newPassword' => 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/',
        ]);
        try {
            $user = Auth::user();

            if (!Hash::check($request->input('current'), $user->password)) {
                return back()->withErrors(['current' => 'Current password is incorrect']);
            }

            $user->password = Hash::make($request->input('newPassword'));
            $user->save();

            return back()->with('status', 'Password updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('current', 'An error occurred while changing your password. Please try again.');
        }
    }
    //-----------------------end controller Profile


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('panel.users.createuser', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.users.createuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|ends_with:@elpato.xyz',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'email_verified_at' => 'required|date',
            'type' => 'required',
            'telegram' => 'required',
        ], [
            'email.ends_with' => 'The email must be a valid @elpato.xyz email address.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least 1 special character.',

        ]);

        try {
            // Criação do novo usuário
            $user = new User();
            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->password = bcrypt($fields['password']); // Criptografar a senha antes de salvar
            $user->email_verified_at = $fields['email_verified_at'];
            $user->type = $fields['type'];
            $user->telegram = $fields['telegram'];
            $user->blocked = 0; // Define o valor padrão para 'blocked'

            do {
                $slug = $this->generateComplexSlug();
            } while (User::where('slug', $slug)->exists());

            $user->slug = $slug;
            // Salvando o usuário no banco de dados
            $user->save();
            Log::channel('user')->info("User created by " . Auth::user()->name . " - User: " . $user->name);
            return redirect()->route('user.all')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the new user. Please try again.');
        }
    }

    private function generateComplexSlug()
    {
        // Define os caracteres permitidos no slug, incluindo números e letras
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Define o meio do slug com letras e números aleatórios (pode ter mais ou menos caracteres)
        $middlePart = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3) . '-' .
            substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2);

        // Gera uma parte aleatória do slug com letras e números
        $randomPart = substr(str_shuffle($characters), 0, 10); // 10 caracteres aleatórios
        $randomPartend = substr(str_shuffle($characters), 0, 10);

        // Cria o slug final com o nome, o meio e a parte aleatória
        return $randomPart . '-' . $middlePart . '-' . $randomPartend;
    }

    public function setDefaultPassword($slug)
    {
        try {
            // Gerar uma senha aleatória
            $defaultPassword = Str::random(12); // Gera 12 caracteres
            $defaultPassword = preg_replace('/([a-zA-Z0-9])/', '$1!', $defaultPassword, 2); // Adiciona caracteres especiais

            // Buscar o usuário
            $user = User::where('slug', $slug)->firstOrFail();

            // Atualizar a senha
            $user->password = bcrypt($defaultPassword);
            $user->save();

            // Logar a ação
            Log::channel('user')->warning("Default password reset for user {$user->name} by admin " . Auth::user()->name);

            // Retornar sucesso
            return response()->json([
                'success' => true,
                'message' => 'Default password set successfully!',
                'password' => $defaultPassword,
            ]);
        } catch (\Exception $e) {
            Log::error('Error setting default password: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while setting the default password.',
            ]);
        }
    }

    public function validatePassword(Request $request)
    {
        $password = $request->input('password');
        $action = $request->input('action');

        // Defina as senhas aqui
        $adminPassword = '!@dmin'; // Permissão de admin
        $blockPassword = '!block'; // Bloquear ou desbloquear usuários

        if (($action === 'type' && $password === $adminPassword) ||
            ($action === 'blocked' && $password === $blockPassword)
        ) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function allshow(Message $messages)
    {
        // Obter usuários ordenados por ID
        $users = User::orderBy('id', 'asc')->get();
        $drops = Drop::all();
        // Ordenar mensagens pelo ID em ordem ascendente
        $messages = Message::orderBy('id', 'asc')->get();
        $messagesCount = Message::count();

        return view('panel.users.allusers', [
            'users' => $users,
            'drops' => $drops,
            'messagesCount' => $messagesCount,
            'messages' => $messages
        ]);
    }


    public function filterUser(Request $request)
    {
        $userRole = $request->input('userRole'); // Campo para selecionar o papel do usuário (admin ou worker)

        if ($userRole) {
            if ($userRole == 'type') {
                $users = User::where('type', 'admin')->get();
            } elseif ($userRole == 'worker') {
                $users = User::where('type', 'default')->get();
            }
        } else {
            $users = User::all();
        }

        return view('panel.users.allusers', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('panel.users.edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $slug = trim(preg_replace('/[^\w-]+/', '', $slug));
        // Validação dos campos
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|ends_with:@elpato.xyz',
            'email_verified_at' => 'required|date',
            'type' => 'required',
            'telegram' => 'required',
            'blocked' => 'required|boolean',
        ], [
            'email.ends_with' => 'The email must be a valid @elpato.xyz email address.',
        ]);

        try {
            $user = User::where('slug', $slug)->firstOrFail();

            // Impede o usuário de alterar seu próprio estado de 'blocked'
            if (auth()->user()->id == $slug) {
                return redirect()->back()->with('error', 'You cannot change your own blocked status.');
            }

            // Impede um admin de mudar a role e o estado de bloqueio de outro admin
            if (auth()->user()->type === 'admin' && $user->type === 'admin') {
                if ($fields['type'] !== $user->type) {
                    return redirect()->back()->with('error', 'You cannot change the role of another admin.');
                }
                if ($fields['blocked'] != $user->blocked) {
                    return redirect()->back()->with('error', 'You cannot change the blocked status of another admin.');
                }
            }

            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->email_verified_at = $fields['email_verified_at'];
            $user->type = $fields['type']; // Isso só será permitido se não for um admin alterando outro admin
            $user->telegram = $fields['telegram'];
            $user->blocked = $fields['blocked'] === '1' ? true : false;

            $user->save();
            Log::channel('user')->info("User updated by " . Auth::user()->name . " - User: " . $user->name);
            return redirect()->route('user.all')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $slug)
    {
        try {
            $user = User::where('slug', $slug)->firstOrFail();
            // Prevent logged-in user from deleting their own account
            if (auth()->user()->id === $user->id) {
                return redirect()->route('user.all')->with('error', 'You cannot delete your own account.');
            }

            // Prevent deletion of other administrators
            if ($user->type === 'admin') {
                return redirect()->route('user.all')->with('error', 'You cannot delete other administrators.');
            }

            // Caminho para a pasta profile_images dentro de public_html
            $profileImagesPath = base_path('../public_html/profile_images');

            // Delete profile image if exists
            if ($user->profile_image && file_exists($profileImagesPath . '/' . $user->profile_image)) {
                unlink($profileImagesPath . '/' . $user->profile_image);
            }

            // Delete the user
            $user->delete();
            Log::channel('user')->warning("User soft deleted by " . Auth::user()->name . " - User: " . $user->name);
            return redirect()->route('user.all')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the user. Please try again.');
        }
    }

    public function allShowDeleted()
    {
        $deletedUsers = User::onlyTrashed()->orderByDesc('id')->get();
        return view('panel.users.softdeletedusers', compact('deletedUsers'));
    }


    public function restore(Request $request, $slug)
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'regex:/^restore\-.+/']
        ]);

        try {
            $user = User::withTrashed()->where('slug', $slug)->firstOrFail();

            $expectedText = 'restore-' . $user->name;
            if ($request->confirmation_text !== $expectedText) {
                return redirect()->back()->with('error', 'Confirmation text does not match.');
            }
            $user->restore();
            Log::channel('user')->info("User restored by " . Auth::user()->name . " - User: " . $user->name);
            return redirect()->route('user.all')->with('success', 'User restored successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring the User. Please try again.');
        }
    }



    public function forceDelete(Request $request, $slug)
    {
        $request->validate([
            'confirmation_text' => ['required', 'string', 'regex:/^delete\-.+/']
        ]);

        try {
            $user = User::withTrashed()->where('slug', $slug)->firstOrFail();
            $expectedText = 'delete-' . $user->name;
            if ($request->confirmation_text !== $expectedText) {
                return redirect()->back()->with('error', 'Confirmation text does not match.');
            }

            $user->forceDelete();

            Log::channel('user')->warning("User permanently deleted by " . Auth::user()->name . " - User: " . $user->name);

            return redirect()->route('user.deleted')->with('success', 'User permanently deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while force deleting the User. Please try again.');
        }
    }
}
