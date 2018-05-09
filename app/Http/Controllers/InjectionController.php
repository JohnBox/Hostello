<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Injection;

class InjectionController extends Controller
{
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $injections = $profile->injections;
        } else {
            $injections = Injection::all();
        }
        return view('injection.index', ['injections' => $injections]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Injection $injection)
    {

    }

    public function edit(Injection $injection)
    {
        //
    }

    public function update(Request $request, Injection $injection)
    {
        //
    }

    public function destroy(Injection $injection)
    {
        //
    }
}
