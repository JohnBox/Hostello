<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\University;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Course;
use App\Models\Group;

class UniversityController extends Controller
{
    function index(Request $request)
    {
        $university = University::first();
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();
        return view('university.index', [
            'university' => $university,
            'faculties' => $faculties,
            'specialties' => $specialties,
            'groups' => $groups
        ]);
    }

    function create()
    {
        $university = University::first();
        return view('university.create', ['university' => $university]);
    }

    function store(Request $request)
    {
        $input = $request->only(['name', 'address', 'phone', 'merchant']);
        $university = University::first();
        if (!$university) {
            University::create($input);
        }
        return redirect()->route('universities.index');
    }

    function edit(University $university)
    {
        return view('university.edit', ['university' => $university]);
    }

    function update(Request $request, University $university)
    {
        $input = $request->only(['name', 'address', 'phone', 'merchant']);
        $university->fill($input);
        $university->save();
        return redirect()->route('universities.index');

    }






}
