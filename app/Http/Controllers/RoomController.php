<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Room;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $rooms = Room::all();
        foreach ($rooms as &$r)
        {
            foreach ($r->livers as &$l) {
                $l->first_name = mb_substr($l->first_name,0,1).'.';
                $l->parent_name = mb_substr($l->parent_name,0,1).'.';
            }

        }


        return view('room.index', ['rooms' => $rooms]);
    }

    public function getShow($id)
    {
        return view('room.show', ['room' => Room::find($id)]);
    }
    public function getSettle($id)
    {

    }
    public function getDeleteLiver($id)
    {

    }
}
