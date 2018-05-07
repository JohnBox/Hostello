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
use App\Models\Pay;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        $profile = Auth::user()->profile;
        $university = University::first();
        if (!$profile) {
            if ($university) {
                return redirect()->route('livers.index');
            }
            return redirect()->route('universities.index');
        }
        else {
            $class = get_class($profile);
            if ($class == 'App\Models\Watchman') {
                return redirect()->route('watchman');
            }
            else {
                return redirect()->route('liver.profile');
            }
        }
    }
}
