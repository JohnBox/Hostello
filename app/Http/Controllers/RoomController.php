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
        $profile = $request->user()->profile;
        if ($profile) {
            $hostels = null;
            $currentHostel = $profile->hostel;
        } else {
            $hostels = Hostel::all();
            $currentHostel = $request->get('hostel')
                ? Hostel::find($request->get('hostel'))
                : $hostels->first();
        }
        if (!$currentHostel) {
            return redirect()->route('universities.index');
        }
        $floor = Floor::find($request->get('floor'));
        $currentFloor = $floor
            ? $floor
            : (count($currentHostel->floors)
                ? $currentHostel->floors[0]
                : null);
        return view('room.index', compact('hostels', 'currentHostel', 'currentFloor'));
    }


    public function create(Request $request)
    {
        $hostelId = $request->get('hostel');
        $hostel = Hostel::find($hostelId);
        if ($hostel) {
            return view('room.create', ['hostel' => $hostel]);
        }
    }

    public function store(Request $request)
    {
        $input = $request->only(['number', 'liver_max', 'block_id', 'hostel_id', 'price', 'price_summer']);
        $room = Room::create($input);
        return redirect()->route('hostels.show', ['hostel' => $room->hostel]);
    }


    public function show(Room $room)
    {
        return view('room.show', ['room' => $room]);
    }

    public function edit(Request $request, Room $room)
    {
        return view('room.edit', ['room' => $room]);
    }

    public function update(Request $request, Room $room)
    {
        $input = $request->only(['number', 'liver_max', 'block_id', 'price', 'price_summer']);
        $room->fill($input);
        $room->save();
        return redirect()->route('hostels.show', ['hostel' => $room->hostel]);
    }

    public function destroy(Room $room)
    {
        $hostel = $room->hostel;
        $room->delete();
        return redirect()->route('hostels.show', ['hostel' => $hostel]);
    }
}
