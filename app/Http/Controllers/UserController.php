<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Drop;

class UserController extends Controller
{
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
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'email_verified_at' => 'required',
            'type' => 'required',
            'telegram' => 'required',
        ]);

        try {
            $user = new User();
            $user->name = $fields['name'];
            $user->email = $fields['email'];
            $user->password = bcrypt($fields['password']); // Criptografar a senha antes de salvar
            $user->email_verified_at = $fields['email_verified_at'];
            $user->type = $fields['type'];
            $user->telegram = $fields['telegram'];
            $user->save();

            return redirect()->route('user.all')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the new user. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    public function allshow()
    {
        $users = User::all();
        $drops = Drop::all();

        return view('allusers', ['users' => $users, 'drops' => $drops]);
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'email_verified_at' => 'required',
            'type' => 'required',
            'telegram' => 'required',
        ]);

        try {

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->email_verified_at = $request->input('email_verified_at');
            $user->type = $request->input('type');
            $user->telegram = $request->input('telegram');
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
            $user->delete();
            return redirect()->route('user.all')->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the User. Please try again.');
        }
    }
}
