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
        foreach (range(1, $specialty->years_of_study) as $number) {
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
        $years_of_study = $specialty->years_of_study;
        $input = $request->only(['name', 'years_of_study', 'faculty_id']);
        $specialty->fill($input);
        $specialty->save();
        if ($specialty->years_of_study > $years_of_study) {
            $number = $specialty->years_of_study - $years_of_study;
            while ($number <= $specialty->years_of_study) {
                $specialty->courses()->create(['number' => $number++]);
            }
        } elseif ($specialty->years_of_study < $years_of_study) {
            $number = $years_of_study;
            while ($number > $specialty->years_of_study) {
                $specialty->courses()->whereNumber($number--)->delete();
            }
        }
        return redirect()->route('universities.index');
    }

    public function destroy(Specialty $specialty)
    {
        $specialty->delete();
        return redirect()->route('universities.index');
    }
}
