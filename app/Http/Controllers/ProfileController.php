<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request)
    {
        $profile = $request->user()->profile;
        return view('profile.index', ['profile' => $profile]);
    }
}
