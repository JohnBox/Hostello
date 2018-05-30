<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Interverntion;

use App\Models\Liver;

class LiverController extends Controller
{
    public function autocomplete(Request $request)
    {
        $state = $request->get('state');
        $term = $request->get('term');
        $hostel = Hostel::find($request->get('hostel'));
        switch ($state) {
            case 'active':
                $livers = Liver::active($hostel);
                break;
            case 'nonactive':
                $livers = Liver::nonactive($hostel);
                break;
            default:
                $livers = Liver::any($hostel);
        }
        $livers = $livers
            ->where('last_name', 'LIKE', "$term%")
            ->orWhere('first_name', 'LIKE', "$term%")
            ->orWhere('second_name', 'LIKE', "$term%")
            ->take(5)->get();
        $results = array();
        foreach ($livers as $liver)
        {
            $results[] = [ 'id' => $liver->id, 'value' => $liver->full_name()];
        }
        return Response::json($results);
    }

    public function index(Request $request)
    {
        $profile = $request->user()->profile;
        if ($profile) {
            $hostels = null;
            $currentHostel = $profile->hostel;
        } else {
            $hostels = Hostel::all();
            $currentHostel = $request->get('hostel')
                ? Hostel::find($request->get('hostel'))
                : $hostels->first();
        }
        $state = $request->get('state');
        switch ($state) {
            case 'active':
                $livers = Liver::active($currentHostel);
                break;
            case 'nonactive':
                $livers = Liver::nonactive($currentHostel);
                break;
            case 'ower':
                $livers = Liver::ower($currentHostel);
                break;
            default:
                $livers = Liver::any($currentHostel);
        }
        $q = $request->get('q');
        if ($q) {
            $livers = $livers->where('id', '=', $q);
        }
        $livers = $livers->orderBy('created_at', 'DESC')->paginate(config('app.paginated_by'))->withPath($request->url());
        return view('liver.index', compact('livers', 'state', 'currentHostel', 'hostels'));
    }

    public function create()
    {
        return view('liver.create', ['university' => University::first()]);
    }
    public function store(Request $request)
    {
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id', 'is_student']);
        if ($request->input('is_student') == '1')
            $input['group_id'] = $request->input('group_id');
        $input['hostel_id'] = $request->user()->profile->hostel->id;
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
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id', 'is_student']);
        if ($request->input('is_student') == '1')
            $input['group_id'] = $request->input('group_id');
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
