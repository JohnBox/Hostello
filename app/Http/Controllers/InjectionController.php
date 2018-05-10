<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Floor;
use App\Models\Room;
use App\Models\Liver;
use App\Models\Injection;

class InjectionController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $injections = $profile->injections;
        } else {
            $injections = Injection::all();
        }
        return view('injection.index', ['injections' => $injections]);
    }

    public function create(Request $request)
    {
        $liver = Liver::find($request->get('liver'));
        $floor = Floor::find($request->get('floor'));
        $hostel = $request->user()->profile->hostel;
        $currentFloor = $floor ? $floor : (count($hostel->floors) ? $hostel->floors[0] : null);
        $floors = $request->user()->profile->hostel->floors;
        return view('injection.create', [
            'floors' => $floors, 'current' => $currentFloor, 'liver' => $liver
        ]);
    }

    public function store(Request $request)
    {
        $liver = Liver::find($request->input('liver_id'));
        $room = Room::find($request->input('room_id'));
        $watchman = $request->user()->profile;
        $injection = new Injection(['date' => date('Y-m-d')]);
        $injection->watchman()->associate($watchman);
        $injection->liver()->associate($liver);
        $injection->room()->associate($room);
        $injection->save();
        $liver->room()->associate($room);
        $liver->is_active = true;
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Injection $injection)
    {
    }

    public function edit(Request $request, Injection $injection)
    {
    }

    public function update(Request $request, Injection $injection)
    {
    }

    public function destroy(Injection $injection)
    {
    }
}
