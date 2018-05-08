<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Hostel;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Room;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function flatten(array $array) {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }

    public function index()
    {
        $floors = Auth::user()->hostel->floors;
        $curruntFloor = count($floors) ? $floors[0] : null;
        $floor = Floor::find($curruntFloor->id);
        $blocks = Block::where('floor_id', '=', $floor->id)->get();
        $rooms = [];
        foreach ($blocks as $block) {
            $rooms[$block->id] = Room::where('block_id', '=', $block->id)->get();
        }
        return view('room.index', [
            'rooms' => $rooms,
            'floors' => $floors,
            'blocks' => $blocks,
            'current' => $curruntFloor
        ]);
    }


    public function create(Request $request)
    {
//        ob_start();
//        var_dump($request->input());
//        return ob_get_clean();
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


    public function getFloor($id)
    {
        $floors = Auth::user()->hostel->floors;
        $curruntFloor = $floors[$id-1];
        $floor = Floor::find($curruntFloor->id);
        $blocks = Block::where('floor_id', '=', $floor->id)->get();
        $rooms = [];
        foreach ($blocks as $block) {
            $rooms[$block->id] = Room::where('block_id', '=', $block->id)->get();
        }
        return view('room.index', [
            'rooms' => $rooms,
            'floors' => $floors,
            'blocks' => $blocks,
            'current' => $curruntFloor
        ]);
    }

    public function getSettle($id)
    {

    }
    public function getDeleteLiver($id)
    {

    }
}
