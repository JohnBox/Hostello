<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Violation;
use App\Models\Liver;


class ViolationController extends Controller
{
    public function index(Request $request)
    {
        $watchman = $request->user()->profile;
        if ($watchman) {
            $violations = $watchman->violations;
        } else {
            $violations = Violation::all();
        }
        return view('violation.index', ['violations' => $violations]);
    }

    public function create(Request $request)
    {
        $watchman = $request->user()->profile;
        return view('violation.create', ['livers' => Liver::all()]);
    }
    public function store(Request $request)
    {
        $watchman = $request->user()->profile;
        $count = count($request->input('livers'));
        $penalty = (float)$request->input('penalty')/$count;
        foreach ($request->input('livers') as $id)
        {
            $liver = Liver::find($id);
            $liver->violations()->create([
                'description' => $request->input('description'),
                'date' => date("Y-m-d", strtotime($request->input('date'))),
                'penalty' => $penalty,
                'paid' => false,
                'watchman_id' => $watchman->id
            ]);
        }
        return redirect()->route('violations.index');
    }
    public function edit(Violation $violation)
    {
        return view('violation.edit', ['violation' => $violation]);
    }
    public function update(Request $request, Violation $violation)
    {
        $violation->description = $request->input('description');
        $violation->date = date("Y-m-d", strtotime($request->input('date')));
        $violation->penalty = $request->input('penalty');
        $violation->save();
        return redirect()->route('violations.index');
    }
    public function destroy(Violation $violation)
    {
        $violation->delete();
        return redirect()->route('violations.index');
    }
}
