<?php

namespace App\Http\Controllers;

use App\Models\Ejection;
use App\Models\Hostel;
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
            $hostels = null;
            $currentHostel = $profile->hostel;
            $injections = $profile->injections();
        } else {
            $hostels = Hostel::all();
            $currentHostel = $request->get('hostel')
                ? Hostel::find($request->get('hostel'))
                : $hostels->first();
            $injections = $currentHostel->injections();
        }
        if ($request->get('q')) {
            $injections = $injections->where('room_id','=', $request->get('q'));
        }
        $injections = $injections->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'));
        return view('injection.index', compact('injections', 'hostels', 'currentHostel'));
    }

    public function create(Request $request)
    {
        $liver = Liver::find($request->get('liver'));
        $floor = Floor::find($request->get('floor'));
        $update = $request->get('update');
        $hostel = $request->user()->profile->hostel;
        $currentFloor = $floor ? $floor : (count($hostel->floors) ? $hostel->floors[0] : null);
        $floors = $hostel->floors;
        return view('injection.create', [
            'floors' => $floors,
            'current' => $currentFloor,
            'liver' => $liver,
            'update' => $update
        ]);
    }

    public function store(Request $request)
    {
        $liver = Liver::find($request->input('liver_id'));
        $room = Room::find($request->input('room_id'));
        $watchman = $request->user()->profile;
        if ($request->get('update')) {
            $ejection = new Ejection(['date' => date('Y-m-d')]);
            $ejection->hostel()->associate($watchman->hostel);
            $ejection->watchman()->associate($watchman);
            $ejection->liver()->associate($liver);
            $ejection->room()->associate($liver->room);
            $ejection->save();
            $liver->room()->dissociate($liver->room);
            $liver->save();
        }
        $injection = new Injection(['date' => date('Y-m-d')]);
        $injection->hostel()->associate($watchman->hostel);
        $injection->watchman()->associate($watchman);
        $injection->liver()->associate($liver);
        $injection->room()->associate($room);
        $injection->save();
        $liver->room()->associate($room);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
}
