<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function index(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'index';
        return view('profile.index', compact('profile', 'page'));
    }

    function payments(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'payments';
        return view('profile.payments', compact('profile', 'page'));
    }

    function violations(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'violations';
        return view('profile.violations', compact('profile', 'page'));
    }

    function injections(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'injections';
        return view('profile.injections', compact('profile', 'page'));
    }

    function ejections(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'ejections';
        return view('profile.ejections', compact('profile', 'page'));
    }
}
