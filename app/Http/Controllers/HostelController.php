<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Floor;
use App\Models\Room;
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
        $university = University::first();
        return view('hostel.create', ['university' => $university]);
    }

    public function store(Request $request)
    {
        $university = University::first();
        $input = $request->input();
        $floorCount = $input['floor_count'];
        $blockCount = $input['block_count'];
        $roomCount = $input['room_count'];
        $liverCount = $input['liver_count'];
        $roomArea = $input['room_area'];
        $input = $request->only(['name', 'address', 'phone', 'area', 'merchant']);
        $hostel = new Hostel($input);
        $university->hostels()->save($hostel);
        foreach (range(1, $floorCount) as $floorNumber) {
            $floor = new Floor(['number' => $floorNumber]);
            $hostel->floors()->save($floor);
            $floor->save();
            foreach (range(1, $blockCount) as $blockNumber) {
                $block = new Block(['number' => $blockNumber]);
                $floor->blocks()->save($block);
                $block->save();
                foreach (range(1, $roomCount) as $roomNumber) {
                    $room = new Room([
                        'number' => $floor->number * 100 + $roomNumber,
                        'liver_max' => $liverCount,
                        'area' => $roomArea
                    ]);
                    $block->rooms()->save($room);
                    $room->save();
                }
            }

        }
        $hostel->save();
        return redirect()->route('hostels.index');
    }

    public function show(Hostel $hostel)
    {
        $university = University::first();
        $rooms = [];
        foreach ($hostel->floors as $floor) {
            foreach ($floor->blocks as $block) {
                foreach ($block->rooms as $room) {
                    $rooms[] = $room;
                }
            }
        }
//        ob_start();
//        var_dump($rooms);
//        return ob_get_clean();
        return view('hostel.show', ['rooms' => $rooms, 'hostel' => $hostel, 'university' => $university]);
    }

    public function edit(Hostel $hostel)
    {
        $university = University::first();
        return view('hostel.edit', ['hostel' => $hostel, 'university' => $university]);
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
