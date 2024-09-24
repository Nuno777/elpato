<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drop;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                // Delete old profile image if exists
                if ($user->profile_image && Storage::exists('public/profile_img/' . $user->profile_image)) {
                    Storage::delete('public/profile_img/' . $user->profile_image);
                }

                // Store new profile image
                $profileImageName = $user->id . '_' . time() . '.' . $request->profile_image->getClientOriginalExtension();
                $request->profile_image->storeAs('public/profile_img', $profileImageName);

                // Update user profile image
                $user->profile_image = $profileImageName;
            }

            // Update telegram username
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
        return view('createuser', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createuser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|ends_with:@elpato.com',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'email_verified_at' => 'required|date',
            'type' => 'required',
            'telegram' => 'required',
        ], [
            'email.ends_with' => 'The email must be a valid @elpato.com email address.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least 1 special character.'
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

            // Salvando o usuário no banco de dados
            $user->save();

            return redirect()->route('user.all')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the new user. Please try again.');
        }
    }



    public function setDefaultPassword($id)
    {
        try {
            $defaultPassword = '!elpato12345';
            $user = User::findOrFail($id);
            $user->password = bcrypt($defaultPassword);
            $user->save();

            return redirect()->back()->with('success', 'Default password set successfully for the selected user!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while setting default password. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function allshow(Message $messages)
    {
        $users = User::all();
        $drops = Drop::all();
        $messages = Message::All();
        $messagesCount = Message::count();

        return view('allusers', ['users' => $users, 'drops' => $drops, 'messagesCount' => $messagesCount, 'messages' => $messages]);
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

        return view('allusers', compact('users'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edituser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos campos
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|ends_with:@elpato.com',
            'email_verified_at' => 'required|date',
            'type' => 'required',
            'telegram' => 'required',
            'blocked' => 'required|boolean',
        ], [
            'email.ends_with' => 'The email must be a valid @elpato.com email address.',
        ]);

        try {
            $user = User::findOrFail($id);

            // Impede o usuário de alterar seu próprio estado de 'blocked'
            if (auth()->user()->id == $id) {
                return redirect()->back()->with('error', 'You cannot change your own blocked status.');
            }

            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->email_verified_at = $fields['email_verified_at'];
            $user->type = $fields['type'];
            $user->telegram = $fields['telegram'];
            $user->blocked = $fields['blocked'] === '1' ? true : false;

            $user->save();

            return redirect()->route('user.all')->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Prevent logged-in user from deleting their own account
            if (auth()->user()->id === $user->id) {
                return redirect()->route('user.all')->with('error', 'You cannot delete your own account.');
            }

            // Delete profile image if exists
            if ($user->profile_image && Storage::exists('public/profile_img/' . $user->profile_image)) {
                Storage::delete('public/profile_img/' . $user->profile_image);
            }
            $user->delete();

            return redirect()->route('user.all')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the user. Please try again.');
        }
    }
}
