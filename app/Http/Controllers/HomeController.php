<?php

namespace App\Http\Controllers;

use App\Models\Watchman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Models\University;
use App\Models\Hostel;
use App\Models\Violation;
use App\Models\Liver;
use App\Models\Payment;


class HomeController extends Controller
{
    function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile && get_class($profile) == 'App\Models\Liver') {
            return redirect()->route('profile.index');
        }
        return redirect()->route('livers.index');
    }

    function changePassword(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('auth.passwords.change');
        } else {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with("error","Невірний старий пароль");
            }
            if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                return redirect()->back()->with("error","Новий і старий пароль однакові");
            }
            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);
            $user = Auth::user();
            $user->password = Hash::make($request->get('new-password'));
            $user->save();
            return redirect()->route('home');
        }
    }
}
