<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            case 'ower':
                $livers = Liver::ower($hostel);
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
        if (!$currentHostel) {
            return redirect()->route('universities.index');
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
        $liver->user()->create([
            'name' => $input['phone']  ,
            'email' => 'watchman' . $liver->id . '@gmail.com',
            'password' => Hash::make($input['phone']),
        ]);
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Request $request, Liver $liver)
    {
        $page = $request->get('page') ?: 'profile';
        $unpaidPayments = $liver->payments()->wherePivot('paid', null)->count();
        $unpaidViolations = $liver->violations()->wherePivot('paid', null)->count();
        return view('liver.show', compact('liver', 'page', 'unpaidPayments', 'unpaidViolations'));
    }
    public function edit(Liver $liver)
    {
        return view('liver.edit', ['liver' => $liver, 'university' => University::first()]);
    }
    public function update(Request $request, Liver $liver)
    {
        $student = (bool)$request->input('is_student');
        $input = $request->except(['specialty_id', 'faculty_id', 'group_id', 'is_student']);
        if ($student) {
            $input['group_id'] = $request->input('group_id');
        } else {
            $liver->group()->dissociate();
        }
        $liver->fill($input);
        $liver->save();
        return redirect()->route('livers.show', ['liver' => $liver]);
    }
    public function destroy(Liver $liver)
    {
        foreach ($liver->payments as $payment) {
            $payment->livers()->detach($liver);
            $payment->save();
        }
        foreach ($liver->violations as $violation) {
            $violation->livers()->detach($liver);
            $violation->save();
        }
        $liver->delete();
        return redirect()->route('livers.index');
    }
}
