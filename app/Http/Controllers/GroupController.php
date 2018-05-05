<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Specialty;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('group.create', ['specialties' => $specialties]);
    }

    public function store(Request $request)
    {
        $input = $request->only(['name', 'leader', 'phone', 'course_id']);
        Group::create($input);
        return redirect()->route('universities.index');
    }

    public function show(Group $group)
    {
        //
    }

    public function edit(Group $group)
    {
        $specialties = Specialty::all();
        return view('group.edit', ['specialties' => $specialties, 'group' => $group]);
    }

    public function update(Request $request, Group $group)
    {
        $input = $request->only(['name', 'leader', 'phone', 'course_id']);
        $group->fill($input);
        $group->save();
        return redirect()->route('universities.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('universities.index');
    }
}
