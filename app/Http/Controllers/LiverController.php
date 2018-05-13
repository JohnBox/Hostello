<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Interverntion;

use App\Models\Hostel;
use App\Models\Room;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Group;
use App\Models\Liver;

class LiverController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('f') ?: 'all';
        switch ($filter) {
            case 'active': $livers = Liver::active(); break;
            case 'nonactive': $livers = Liver::nonactive(); break;
            case 'all': $livers = Liver::all(); break;
        }
        $livers = Liver::withCount('violations')->get();
        return view('liver.index', ['livers' => $livers, 'filter' => $filter]);
    }

    public function create()
    {
        return view('liver.create', ['university' => University::first()]);
    }
    public function store(Request $request)
    {
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id']);
        if ($input['is_student'] == '1')
            $input['group_id'] = $request->input('group_id');
        $liver = Liver::create($input);
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Request $request, Liver $liver)
    {
        $page = $request->get('page') ?: 'profile';
        return view('liver.show', ['liver' => $liver, 'page' => $page]);
    }
    public function edit(Liver $liver)
    {
        return view('liver.edit', ['liver' => $liver, 'university' => University::first()]);
    }
    public function update(Request $request, Liver $liver)
    {
        $input = $request->except(['specialty_id']);
        $liver->fill($input);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
    public function destroy(Liver $liver)
    {
        $liver->delete();
        return redirect()->route('livers.index');
    }
}
