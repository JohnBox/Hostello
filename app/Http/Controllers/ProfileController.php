<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function getIndex(Request $request)
    {
        $profile = $request->user()->liver;
        return view('profile.index', ['profile' => $profile]);
    }
}
