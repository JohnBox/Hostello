<?php

namespace App\Http\Controllers;

use App\Models\Liver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Hostel;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Room;
use Illuminate\Support\Facades\Response;

class RoomController extends Controller
{
    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        $rooms = Room::where('number', 'LIKE', "$term%")->take(5)->get();
        $results = array();
        foreach ($rooms as $room)
        {
            $results[] = [ 'id' => $room->id, 'value' => $room->number];
        }
        return Response::json($results);
    }

    function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }

    public function index(Request $request)
    {
        $floor = Floor::find($request->get('floor'));
        $hostel = $request->user()->profile->hostel;
        $currentFloor = $floor ? $floor : (count($hostel->floors) ? $hostel->floors[0] : null);
        return view('room.index', [
            'hostel' => $hostel,
            'current' => $currentFloor
        ]);
    }


    public function create(Request $request)
    {
        $hostelId = $request->get('hostel');
        $hostel = Hostel::find($hostelId);
        if ($hostel) {
            return view('room.create', ['floors' => $hostel->floors]);
        }
    }

    public function store(Request $request)
    {
        $input = $request->only(['number', 'liver_max', 'area', 'block_id']);
        $room = Room::create($input);
        return redirect()->route('hostels.show', ['hostel' => $room->block->floor->hostel]);
    }


    public function show(Room $room)
    {
        return view('room.show', ['room' => $room]);
    }

    public function edit(Request $request, Room $room)
    {
        $hostelId = $request->get('hostel');
        $hostel = Hostel::find($hostelId);
        if ($hostel) {
            return view('room.edit', ['room' => $room, 'floors' => $hostel->floors]);
        }
    }

    public function update(Request $request, Room $room)
    {
        $input = $request->only(['number', 'liver_max', 'area', 'block_id']);
        $room->fill($input);
        $room->save();
        return redirect()->route('hostels.show', ['hostel' => $room->block->floor->hostel]);
    }

    public function destroy(Room $room)
    {
        $hostel = $room->block->floor->hostel;
        $room->delete();
        return redirect()->route('hostels.show', ['hostel' => $hostel]);
    }
}
