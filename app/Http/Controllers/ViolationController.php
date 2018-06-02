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
            if (!$currentHostel) {
                return redirect()->route('universities.index');
            }
            $violations = $currentHostel->violations();
        }

        $q = $request->get('q');
        if ($q) {
            $violations = $violations->where('date', '=', $q);
        }
        $violations = $violations->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'));
        return view('violation.index', compact('violations', 'q', 'currentHostel', 'hostels'));
    }

    public function create(Request $request)
    {
        $livers = $request->user()->profile->hostel->livers;
        return view('violation.create', compact('livers'));
    }
    public function store(Request $request)
    {
        $profile = $request->user()->profile;
        $violation = $profile->violations()->create([
            'description' => $request->input('description'),
            'date' => date("Y-m-d"),
            'hostel_id' => $profile->hostel->id
        ]);
        $pivot = ['price' => $request->input('price')];
        foreach ($request->input('livers') as $id) {
            $liver = Liver::find($id);
            $liver->violations()->attach($violation, $pivot);
            $liver->balance -= $pivot['price'];
            $liver->save();
        }
        return redirect()->route('violations.index');
    }

    public function show(Request $request, Violation $violation)
    {
        $paid = $request->get('paid');
        if ($paid == null) $paid = true;
        $livers = $violation->livers()->wherePivot('paid', $paid ? '<>' : '=', null)->paginate(config('app.paginated_by'));
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
