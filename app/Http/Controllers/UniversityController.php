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
    function __construct()
    {
        $this->middleware('auth');
    }

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

    function edit(University $university)
    {
        return view('university.edit', ['university' => $university]);
    }

    function store(Request $request)
    {
        $input = $request->only(['name', 'address', 'phone', 'merchant']);
        $university = University::first();
        if (!$university) {
            University::create($input);
        } else {
            $university->fill($input);
            $university->save();
        }
        return redirect()->route('universities.index');
    }




}
