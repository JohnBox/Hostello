<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Course;

class SpecialtyController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $faculties = Faculty::all();
        return view('specialty.create', ['faculties' => $faculties]);
    }

    public function store(Request $request)
    {
        $input = $request->only(['name', 'years_of_study', 'faculty_id']);
        $specialty = Specialty::create($input);
        $courses = [];
        foreach (range(1, $specialty->years_of_study) as $number)
        {
            $courses[] = new Course(['number' => $number]);
        }
        $specialty->courses()->saveMany($courses);


        return redirect()->route('universities.index');
    }

    public function show(Specialty $specialty)
    {
        //
    }

    public function edit(Specialty $specialty)
    {
        $faculties = Faculty::all();
        return view('specialty.edit', ['specialty' => $specialty, 'faculties' => $faculties]);
    }

    public function update(Request $request, Specialty $specialty)
    {
        $input = $request->only(['name', 'years_of_study', 'faculty_id']);
        $specialty->fill($input);
        $specialty->save();
        return redirect()->route('universities.index');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('universities.index');
    }
}
