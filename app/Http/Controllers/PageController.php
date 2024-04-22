<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\User;

use function Laravel\Prompts\alert;

class PageController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard()
    {
        $dropCount = Drop::count();

        return view('dashboard', ['dropCount' => $dropCount]);
    }

    public function adminpainel()
    {
        $users = User::all();
        return view('adminpainel', compact('users'));
    }
}
