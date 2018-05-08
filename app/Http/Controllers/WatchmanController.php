<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\University;
use App\Models\Hostel;
use App\Models\User;
use App\Models\Watchman;

class WatchmanController extends Controller
{
    function index()
    {
        return view('watchman.index');
    }

    function create()
    {
        $iniversity = University::first();
        $hostels = Hostel::all();
        return view('watchman.create', ['hostels' => $hostels , 'university' => $iniversity]);
    }

    function store(Request $request)
    {
        $university = University::first();
        $input = $request->only(['last_name', 'first_name', 'second_name', 'phone', 'hostel_id']);
        $watchman = Watchman::create($input);
        $user = User::create([
            'name' => $input['phone']  ,
            'email' => 'watchman' . $watchman->id . '@gmail.com',
            'password' => Hash::make($input['phone']),
        ]);
        $watchman->user()->save($user);
        return redirect()->route('hostels.index', ['university' => $university]);
    }

    function show(Watchman $watchman)
    {
        //
    }

    function edit(Watchman $watchman)
    {
        $iniversity = University::first();
        $hostels = Hostel::all();
        return view('watchman.edit', ['watchman' => $watchman, 'hostels' => $hostels, 'university' => $iniversity]);
    }

    function update(Request $request, Watchman $watchman)
    {
        $input = $request->only(['last_name', 'first_name', 'second_name', 'phone', 'hostel_id']);
        $watchman->fill($input);
        $watchman->save();
        return redirect()->route('hostels.index');
    }

    function destroy(Watchman $watchman)
    {
        $watchman->delete();
        return redirect()->route('hostels.index');
    }
}
