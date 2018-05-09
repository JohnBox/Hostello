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

    public function index(Request $request)
    {
        $hostel = $request->user()->profile->hostel;
        $curruntFloor = count($hostel->floors) ? $hostel->floors[0] : null;
        return view('room.index', [
            'hostel' => $hostel,
            'current' => $curruntFloor
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


    public function floor(Request $request, $id)
    {
        $hostel = $request->user()->profile->hostel;
        $curruntFloor = count($hostel->floors) ? $hostel->floors[$id-1] : null;
        return view('room.index', [
            'hostel' => $hostel,
            'current' => $curruntFloor
        ]);
    }

    public function injection(Request $request, Liver $liver)
    {
        $watchman = $request->user()->profile;
        if ($request->isMethod('get')) {
            $hostel = $watchman->hostel;
            $currentFloor = count($hostel->floors) ? $hostel->floors[0] : null;
            ob_start();
            var_dump($liver);
            return ob_get_clean();
            return view('room.settle', [
                'liver' => $liver,
                'hostel' => $hostel,
                'current' => $currentFloor
            ]);
        } else {
            ob_start();
            var_dump($liver);
            return ob_get_clean();
            $room = Room::find($request->input('room'));
            $watchman->injections()->create([
                'liver_id' => $liver->id,
                'room_id' => $room->id,
                'date' => date('Y-m-d')
            ]);
            $room->livers()->save($liver);
            $liver->is_active = true;
            $liver->save();
            return redirect()->route('livers.show', ['liver' => $liver]);
        }
    }

    public function ejection(Request $request, Liver $liver)
    {
        $watchman = $request->user()->profile;
        $room = $liver->room;
        $watchman->ejections()->create([
            'liver_id' => $liver->id,
            'room_id' => $room->id,
            'date' => date('Y-m-d')
        ]);
        $liver->room()->dissociate();
        $liver->is_active = false;
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);

    }

    public function rejection(Request $request, Liver $liver)
    {
        if ($request->isMethod('get')) {
            $hostel = $request->user()->profile->hostel;
            $curruntFloor = count($hostel->floors) ? $hostel->floors[0] : null;
            return view('room.settle', [
                'liver' => $liver,
                'hostel' => $hostel,
                'current' => $curruntFloor
            ]);
        } else {
            $room = Room::find($request->input('room'));
            $liver->room()->dissociate();
            $liver->room()->associate($room);
            $liver->is_active = true;
            $liver->save();
            return redirect()->route('livers.show', ['liver' => $liver]);
        }
    }
}
