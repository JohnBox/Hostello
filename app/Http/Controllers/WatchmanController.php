<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hostel;
use App\Models\Watchman;

class WatchmanController extends Controller
{
    function index()
    {
        return view('watchman.index');
    }

    function create()
    {
        $hostels = Hostel::all();
        return view('watchman.create', ['hostels' => $hostels]);
    }

    function store(Request $request)
    {
        $input = $request->only(['last_name', 'first_name', 'second_name', 'phone', 'hostel_id']);
        Watchman::create($input);
        return redirect()->route('hostels.index');
    }

    function show(Watchman $watchman)
    {
        //
    }

    function edit(Watchman $watchman)
    {
        $hostels = Hostel::all();
        return view('watchman.edit', ['watchman' => $watchman, 'hostels' => $hostels]);
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
