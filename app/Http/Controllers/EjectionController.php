<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Liver;
use App\Models\Ejection;

class EjectionController extends Controller
{
    public function index()
    {
        $ejections = Ejection::all();
        return view('ejection.index', ['ejections' => $ejections]);
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
        $liver->is_active = false;
        $liver->save();
        return redirect()->back();
    }

    public function store(Request $request, Liver $liver)
    {

    }

    public function show(Ejection $ejection)
    {
        //
    }

    public function edit(Ejection $ejection)
    {
        //
    }

    public function update(Request $request, Ejection $ejection)
    {
        //
    }
}
