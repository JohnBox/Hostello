<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\University;
use App\Models\Hostel;
use App\Models\Watchman;

class HostelController extends Controller
{
    public function index()
    {
        $university = University::first();
        $hostels = Hostel::all();
        $watchmen = Watchman::all();
        return view('hostel.index', [
            'university' => $university,
            'watchmen' => $watchmen,
            'hostels' => $hostels,
        ]);
    }

    public function create()
    {
        return view('hostel.create');
    }

    public function store(Request $request)
    {
        $university = University::first();
        $input = $request->only(['name', 'address', 'phone', 'area', 'merchant']);
        $input['university_id'] = $university->id;
        Hostel::create($input);
        return redirect()->route('hostels.index');
    }

    public function show(Hostel $hostel)
    {
        //
    }

    public function edit(Hostel $hostel)
    {
        return view('hostel.edit', ['hostel' => $hostel]);
    }

    public function update(Request $request, Hostel $hostel)
    {
        $input = $request->only(['name', 'address', 'phone', 'area', 'merchant']);
        $hostel->fill($input);
        $hostel->save();
        return redirect()->route('hostels.index');
    }

    public function destroy(Hostel $hostel)
    {
        $hostel->delete();
        return redirect()->route('hostels.index');
    }
}
