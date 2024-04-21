<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;

class PageController extends Controller
{
    public function index()
    {
        $dropCount = Drop::count();
        return view('dashboard')->with('dropCount', $dropCount);
    }



    public function adminpainel()
    {
        return view('adminpainel');
    }
}
