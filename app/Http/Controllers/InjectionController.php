<?php

namespace App\Http\Controllers;

use App\Models\Injection;
use Illuminate\Http\Request;

class InjectionController extends Controller
{
    public function index()
    {
        $injections = Injection::all();
        return view('injection.index', ['injections' => $injections]);
    }

    public function create()
    {
        return view('injection.create');
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
