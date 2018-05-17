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
            $violations = $watchman->violations();
        } else {
            $violations = Violation::query();
        }
        return view('violation.index', ['violations' => $violations->paginate(config('app.paginated_by'))]);
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
        $violation = $watchman->violations()->create([
            'description' => $request->input('description'),
            'date_of_charge' => date("Y-m-d"),
        ]);
        $pivot = [
            'penalty' => $request->input('penalty')/$count,
            'paid' => (int)rand(0,1)? null : date('Y-m-d')
        ];
        foreach ($request->input('livers') as $id)
        {
            $liver = Liver::find($id);
            $liver->violations()->attach($violation, $pivot);
            $violation->save();
        }
        return redirect()->route('violations.index');
    }

    public function show(Request $request, Violation $violation)
    {
        return view('violation.show', ['livers' => $violation->livers()->paginate(config('app.paginated_by'))]);
    }

    public function edit(Violation $violation)
    {
        return view('violation.edit', ['violation' => $violation]);
    }
    public function update(Request $request, Violation $violation)
    {
        $violation->description = $request->input('description');
        $violation->save();
        return redirect()->route('violations.index');
    }
    public function destroy(Violation $violation)
    {
        $violation->delete();
        return redirect()->route('violations.index');
    }
}
