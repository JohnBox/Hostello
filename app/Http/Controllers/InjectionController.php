<?php

namespace App\Http\Controllers;

use App\Models\Ejection;
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
            $injections = $profile->injections();
        } else {
            $injections = Injection::query();
        }
        if ($request->get('q')) {
            $injections = $injections->where('room_id','=', $request->get('q'));
        }
        $injections = $injections->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'));
        return view('injection.index', ['injections' => $injections]);
    }

    public function create(Request $request)
    {
        $floor = Floor::find($request->get('floor'));
        $liver = Floor::find($request->get('liver'));
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
            $ejection = new Ejection(['date' => date('d.m.Y')]);
            $ejection->watchman()->associate($watchman);
            $ejection->liver()->associate($liver);
            $ejection->room()->associate($liver->room);
            $ejection->save();
            $liver->room()->dissociate($liver->room);
            $liver->save();
        }
        $injection = new Injection(['date' => date('Y-m-d')]);
        $injection->watchman()->associate($watchman);
        $injection->liver()->associate($liver);
        $injection->room()->associate($room);
        $injection->save();
        $liver->room()->associate($room);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
}
