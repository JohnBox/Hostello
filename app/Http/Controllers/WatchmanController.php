<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WatchmanController extends Controller
{
    function index(){
        return view('watchman.index');
    }
}
