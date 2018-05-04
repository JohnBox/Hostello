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

    public function getIndex()
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


    public function getShow($id)
    {
        return view('room.show', ['room' => Room::find($id)]);
    }
    public function getSettle($id)
    {

    }
    public function getDeleteLiver($id)
    {

    }
}
