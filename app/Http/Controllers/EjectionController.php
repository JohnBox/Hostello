<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ejection;

class EjectionController extends Controller
{
    public function index()
    {
        $ejections = Ejection::all();
        return view('ejection.index', ['ejections' => $ejections]);
    }

    public function create()
    {

    }

    public function store(Request $request)
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

    public function destroy(Ejection $ejection)
    {
        //
    }
}
