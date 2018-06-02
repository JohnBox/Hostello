<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;

use App\Models\Liver;
use App\Models\Ejection;

class EjectionController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $hostels = null;
            $currentHostel = $profile->hostel;
            $ejections = $profile->ejections();
        } else {
            $hostels = Hostel::all();
            $currentHostel = $request->get('hostel')
                ? Hostel::find($request->get('hostel'))
                : $hostels->first();
            if (!$currentHostel) {
                return redirect()->route('universities.index');
            }
            $ejections = $currentHostel->ejections();
        }

        if ($request->get('q')) {
            $ejections = $ejections->where('room_id','=', $request->get('q'));
        }
        $ejections = $ejections->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'));
        return view('ejection.index', compact('ejections', 'hostels', 'currentHostel'));
    }

    public function create(Request $request)
    {
        $liver = Liver::find($request->get('liver'));
        $room = $liver->room;
        $watchman = $request->user()->profile;
        $ejection = new Ejection(['date' => date('Y-m-d')]);
        $ejection->watchman()->associate($watchman);
        $ejection->liver()->associate($liver);
        $ejection->room()->associate($room);
        $ejection->save();
        $liver->room()->dissociate();
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
}
