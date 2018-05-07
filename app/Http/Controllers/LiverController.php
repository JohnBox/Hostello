<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Hostel;
use App\Models\Room;
use App\Models\Faculty;
use App\Models\Specialty;
use App\Models\Group;
use App\Models\Liver;

class LiverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $livers = Liver::all();
        return view('liver.index', ['livers' => $livers]);
    }
    public function getActive()
    {
        $livers = Liver::active();
        return view('liver.active', ['livers' => $livers]);
    }
    public function getNonactive()
    {
        $livers = Liver::nonactive();
        return view('liver.nonactive', ['livers' => $livers]);
    }
    public function getRemoved()
    {
        $livers = Liver::removed();
        return view('liver.removed', ['livers' => $livers]);
    }
    public function create()
    {
        $faculties = Faculty::all();
        $specialties = Specialty::all();
        $groups = Group::all();
        return view('liver.create', ['faculties' => $faculties, 'specialties' => $specialties, 'groups' => $groups]);
    }
    public function store(Request $request)
    {
        $hostel = Hostel::first();
        $input = $request->input();
        $input['hostel_id'] = $hostel->id;
        $liver = Liver::create($input);
        return redirect()->route('livers.show', ['liver' => $liver]);
    }

    public function show(Liver $liver)
    {
        return view('liver.show', ['liver' => $liver]);
    }
    public function edit(Liver $liver)
    {
        $faculties = Faculty::all();
        $groups = Group::all();
        return view('liver.edit', ['liver' => $liver, 'groups' => $groups, 'faculties' => $faculties]);
    }
    public function update(Request $request, Liver $liver)
    {
        $input = $request->only([
            'last_name', 'first_name', 'second_name', 'birth_date', 'gender', 'student', 'doc_number', 'phone',
            'balance',
            ]);
        $liver->last_name = $request->input('last_name');
        $liver->first_name = $request->input('first_name');
        $liver->parent_name = $request->input('parent_name');
        $liver->birth = date("Y-m-d", strtotime($request->input('birth')));
        $liver->sex = $request->input('sex');
        $liver->student = ($request->input('student') == 'on')?true:false;
        $liver->group_id = ($request->input('student') == 'on')?$request->input('group'):0;
        $liver->country = $request->input('country');
        $liver->canton = $request->input('canton');
        $liver->city = $request->input('city');
        $liver->street = $request->input('street');
        $liver->house = $request->input('house');
        $liver->apart = $request->input('apart');
        $liver->series = $request->input('series');
        $liver->number = $request->input('number');
        $liver->which = $request->input('which');
        $liver->when = date("Y-m-d", strtotime($request->input('when')));
        $liver->tel1 = $request->input('tel1');
        $liver->tel2 = $request->input('tel2');
        $liver->tel3 = $request->input('tel3');
        $liver->save();
        return Redirect::to('/livers');
    }
    public function getDelete($id)
    {
        Liver::destroy($id);
        return Redirect::to('/livers');
    }
    public function getShow($id)
    {
        $l = Liver::find($id);
        $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
        return view('liver.show', ['liver' => $l]);
    }
    public function getSettle($id)
    {
        $liver = Liver::find($id);
        $rooms = Room::all();
        foreach ($rooms as &$room)
        {
            foreach ($room->livers as $l)
            {
                if ($l->sex != $liver->sex)
                {
                    $room = null;
                    break;
                }
            }
        }
        return view('liver.settle', ['rooms' => $rooms , 'liver' => $liver ]);
    }
    public function postSettle(Request $req)
    {
        $liver = Liver::find($req->input('id'));
        $room = Room::find($req->input('room'));
        $liver->room_id = $room->id;
        $liver->live_in = date('Y-m-d');
        $liver->is_active = true;
        $liver->save();
        $room->livers()->save($liver);
        return Redirect::to('/livers');
    }
    public function getRemove($id)
    {
        $liver = Liver::find($id);
        $liver->room_id = null;
        $liver->is_active = false;
        $liver->live_out = date('Y-m-d');
        $liver->save();
        return Redirect::to('/livers');
    }
    public function getMoney($id)
    {
        return view('liver.money', ['liver' => Liver::find($id)]);
    }
    public function postMoney(Request $req)
    {
        $l = Liver::find($req->input('id'));
        $l->balance += $req->input('suma');
        $l->save();
        return Redirect::to('/livers');
    }
}
