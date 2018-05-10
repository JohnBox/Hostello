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
    function index()
    {
        $profile = Auth::user()->profile;
        if ($profile && get_class($profile) == 'App\Models\Liver') {
            return redirect()->route('profiles.index');
        }
        return redirect()->route('livers.index');
    }
}
