<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Interverntion;

use App\Models\Hostel;
use App\Models\Room;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Group;
use App\Models\Liver;

class LiverController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        $filter = $request->get('f');
        $livers = [];
        if ($profile) {
            if ($filter == 'active') {
                foreach ($profile->hostel->floors as $floor) {
                    foreach ($floor->blocks as $block) {
                        foreach ($block->rooms as $room) {
                            foreach ($room->livers as $liver) {
                                if ($liver->is_active) {
                                    $livers[] = $liver;
                                }
                            }
                        }
                    }
                }
            } elseif ($filter == 'nonactive') {
                foreach ($profile->hostel->floors as $floor) {
                    foreach ($floor->blocks as $block) {
                        foreach ($block->rooms as $room) {
                            foreach ($room->livers as $liver) {
                                if (!$liver->is_active) {
                                    $livers[] = $liver;
                                }
                            }
                        }
                    }
                }
            } else {
                foreach ($profile->hostel->floors as $floor) {
                    foreach ($floor->blocks as $block) {
                        foreach ($block->rooms as $room) {
                            foreach ($room->livers as $liver) {
                                $livers[] = $liver;
                            }
                        }
                    }
                }
            }
        }
        return view('liver.index', ['livers' => $livers, 'filter' => $filter]);
    }

    public function create()
    {
        return view('liver.create', ['university' => University::first()]);
    }
    public function store(Request $request)
    {
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id']);
        $liver = Liver::create($input);
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Liver $liver)
    {
        return view('liver.show', ['liver' => $liver]);
    }
    public function edit(Liver $liver)
    {
        return view('liver.edit', ['liver' => $liver, 'university' => University::first()]);
    }
    public function update(Request $request, Liver $liver)
    {
        $input = $request->except(['specialty_id']);
        $liver->fill($input);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
    public function destroy(Liver $liver)
    {
        $liver->delete();
        return redirect()->route('livers.index');
    }
}
