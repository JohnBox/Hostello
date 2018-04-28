<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Liver;
use App\Models\Faculty;
use App\Models\Room;
use App\Models\Group;

class LiverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $livers = Liver::all();
        foreach ($livers as &$l) {
            $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
            $l->live_in= implode('.', array_reverse(explode('-',$l->live_in)));
            $l->live_out = implode('.', array_reverse(explode('-',$l->live_out)));
        }
        return view('liver.index', ['livers' => $livers]);
    }
    public function getActive()
    {
        $livers = Liver::active();
        foreach ($livers as &$l) {
            $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
        }
        return view('liver.active', ['livers' => $livers]);
    }
    public function getNonactive()
    {
        $livers = Liver::nonactive();
        foreach ($livers as &$l) {
            $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
        }
        return view('liver.nonactive', ['livers' => $livers]);
    }
    public function getRemoved()
    {
        $livers = Liver::removed();
        foreach ($livers as &$l) {
            $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
        }
        return view('liver.removed', ['livers' => $livers]);
    }
    public function getCreate()
    {
        return view('liver.create', ['faculties' => Faculty::all(), 'groups' => Group::all()]);
    }
    public function postCreate(Request $req)
    {
        $l = Liver::create([
            'last_name' => $req->input('last_name'),
            'first_name' => $req->input('first_name'),
            'parent_name' => $req->input('parent_name'),
            'birth' => date("Y-m-d", strtotime($req->input('birth'))),
            'sex' => $req->input('sex'),
            'student' => ($req->input('student') == 'on')?true:false,
            'group_id' => ($req->input('student') == 'on')?$req->input('group'):0,
            'country' => $req->input('country'),
            'canton' => $req->input('canton'),
            'city' => $req->input('city'),
            'street' => $req->input('street'),
            'house' => $req->input('house'),
            'apart' => $req->input('apart'),
            'series' => $req->input('series'),
            'number' => $req->input('number'),
            'which' => $req->input('which'),
            'when' => date("Y-m-d", strtotime($req->input('when'))),
            'tel1' => $req->input('tel1'),
            'tel2' => $req->input('tel2'),
            'tel3' => $req->input('tel3'),
            'balance' => 0.0,

        ]);
        return Redirect::to('/livers/settle/'.$l->id);
    }
    public function getEdit($id)
    {
        $l = Liver::find($id);
        $l->birth = implode('.', array_reverse(explode('-',$l->birth)));
        return view('liver.edit', ['liver' => $l, 'groups' => Group::all(), 'faculties' => Faculty::all()]);
    }
    public function postEdit(Request $req)
    {
        $liver = Liver::find($req->input('id'));
        $liver->last_name = $req->input('last_name');
        $liver->first_name = $req->input('first_name');
        $liver->parent_name = $req->input('parent_name');
        $liver->birth = date("Y-m-d", strtotime($req->input('birth')));
        $liver->sex = $req->input('sex');
        $liver->student = ($req->input('student') == 'on')?true:false;
        $liver->group_id = ($req->input('student') == 'on')?$req->input('group'):0;
        $liver->country = $req->input('country');
        $liver->canton = $req->input('canton');
        $liver->city = $req->input('city');
        $liver->street = $req->input('street');
        $liver->house = $req->input('house');
        $liver->apart = $req->input('apart');
        $liver->series = $req->input('series');
        $liver->number = $req->input('number');
        $liver->which = $req->input('which');
        $liver->when = date("Y-m-d", strtotime($req->input('when')));
        $liver->tel1 = $req->input('tel1');
        $liver->tel2 = $req->input('tel2');
        $liver->tel3 = $req->input('tel3');
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
        $liver->active = true;
        $liver->save();
        $room->livers()->save($liver);
        return Redirect::to('/livers');
    }
    public function getRemove($id)
    {
        $liver = Liver::find($id);
        $liver->room_id = null;
        $liver->active = false;
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
