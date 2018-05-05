<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\University;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('faculty.create');
    }

    public function store(Request $request)
    {
        $university = University::first();
        $input = $request->only(['name']);
        $input['short_name'] = implode('', array_map(function ($word) { strtoupper($word[0]); }, explode(' ', $input['name'])));
        $input['university_id'] = $university->id;
        Faculty::create($input);
        return redirect()->route('universities.index');
    }

    public function show(Faculty $faculty)
    {
        //
    }

    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', ['faculty' => $faculty]);
    }

    public function update(Request $request, Faculty $faculty)
    {
        $input = $request->only(['name']);
        $faculty->fill($input);
        $faculty->save();
        return redirect()->route('universities.index');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('universities.index');
    }
}
