<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Violation;
use App\Models\Liver;
use Illuminate\Support\Facades\Response;


class ViolationController extends Controller
{
    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        $violations = Violation::where('description', 'LIKE', "%$term%")->take(5)->get();
        $results = array();
        foreach ($violations as $violation)
        {
            $results[] = [ 'id' => $violation->id, 'value' => $violation->description];
        }
        return Response::json($results);
    }
    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $hostels = null;
            $currentHostel = $profile->hostel;
            $violations = $profile->violations();

        } else {
            $hostels = Hostel::all();
            $currentHostel = $request->get('hostel')
                ? Hostel::find($request->get('hostel'))
                : $hostels->first();
            $violations = $currentHostel->violations();
        }
        $q = $request->get('q');
        if ($q) {
            $violations = $violations->where('date_of_charge', '=', $q);
        }
        $violations = $violations->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'));
        return view('violation.index', compact('violations', 'q', 'currentHostel', 'hostels'));
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
            'penalty' => $request->input('penalty'),
            'paid' => rand(0,1) > 0.5 ? null : date('Y-m-d')
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
        $paid = $request->get('paid');
//        ob_start();var_dump($violation->livers); return ob_get_clean();
        $livers = $violation->livers()->wherePivot('paid', 0)->paginate(config('app.paginated_by'));
        
        return view('violation.show', compact('violation', 'livers', 'paid'));
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
