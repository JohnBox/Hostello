<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Liver;
use App\Models\Ejection;

class EjectionController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $ejections = $profile->ejections();
        } else {
            $ejections = Ejection::query();
        }
        return view('ejection.index', ['ejections' => $ejections->paginate(config('app.paginated_by'))]);
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
