<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

use App\Models\Hostel;
use App\Models\Floor;
use App\Models\Block;
use App\Models\Room;
use App\Models\User;
use App\Models\Group;
use App\Models\Faculty;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if (Auth::check() && Auth::user()->name != 'admin') {
            Redirect::to('/');
        }
    }

    public function getIndex()
    {
        return view('setting.index', [
            'hostels' => Hostel::all(),
            'users' => User::all(),
            'rooms' => Room::orderBy('number', 'asc')->get(),
            'faculties' => Faculty::all(),
            'groups' => Group::all(),
        ]);
    }

    public function getCreateHostel()
    {
        return view('setting.create-hostel');
    }

    public function postCreateHostel(Request $req)
    {
        Hostel::create([
            'name' => $req->input('name'),
            'address' => $req->input('address'),
            'phone' => $req->input('phone'),
            'area' => $req->input('area')
        ]);
        return Redirect::to('/settings');
    }

    public function getEditHostel($id)
    {
        return view('setting.edit-hostel', ['hostel' => Hostel::find($id)]);
    }

    public function postEditHostel(Request $req)
    {
        $hostel = Hostel::find($req->input('id'));
        $hostel->name = $req->input('name');
        $hostel->address = $req->input('address');
        $hostel->phone = $req->input('phone');
        $hostel->area = $req->input('area');
        $hostel->save();
        return Redirect::to('settings');
    }

    public function getDeleteHostel($id)
    {
        Hostel::destroy($id);
        return Redirect::to('/settings');
    }

    public function getCreateUser()
    {
        return view('setting.create-user', ['hostels' => Hostel::all()]);
    }

    public function postCreateUser(Request $req)
    {
        User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make('admin'),
            'hostel_id' => $req->input('hostel')
        ]);
        return Redirect::to('/settings');
    }

    public function getEditUser($id)
    {
        return view('setting.edit-user', ['user' => User::find($id), 'hostels' => Hostel::all()]);
    }

    public function postEditUser(Request $req)
    {
        $user = User::find($req->input('id'));
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make('admin');
        $user->hostel_id = $req->input('hostel');
        $user->save();
        return Redirect::to('/settings');
    }

    public function getDeleteUser($id)
    {
        User::destroy($id);
        return Redirect::to('/settings');
    }

    public function getCreateFaculty()
    {
        return view('setting.create-faculty');
    }

    public function postCreateFaculty(Request $req)
    {
        Faculty::create([
            'name' => $req->input('name'),
            'short_name' => $req->input('short_name'),
            'years' => $req->input('years')
        ]);
        return Redirect::to('/settings');
    }

    public function getEditFaculty($id)
    {
        return view('setting.edit-faculty', ['faculty' => Faculty::find($id)]);
    }

    public function postEditFaculty(Request $req)
    {
        $faculty = Faculty::find($req->input('id'));
        $faculty->name = $req->input('name');
        $faculty->short_name = $req->input('short_name');
        $faculty->years = $req->input('years');
        $faculty->save();
        return Redirect::to('/settings');
    }

    public function getDeleteFaculty($id)
    {
        Faculty::destroy($id);
        return Redirect::to('/settings');
    }

    public function getCreateGroup()
    {
        return view('setting.create-group', ['faculties' => Faculty::all()]);
    }
    public function postCreateGroup(Request $req)
    {
        Group::create([
            'number' => $req->input('number'),
            'course' => $req->input('course'),
            'leader' => $req->input('leader'),
            'phone' => $req->input('phone'),
            'faculty_id' => $req->input('faculty')
        ]);
        return Redirect::to('/settings');
    }
    public function getEditGroup($id)
    {
        return view('setting.edit-group', ['group' => Group::find($id), 'faculties' => Faculty::all()]);
    }
    public function postEditGroup(Request $req)
    {
        $group = Group::find($req->input('id'));
        $group->number = $req->input('number');
        $group->course = $req->input('course');
        $group->leader = $req->input('leader');
        $group->faculty_id = $req->input('faculty');
        $group->save();
        return Redirect::to('/settings');
    }
    public function getDeleteGroup($id)
    {
        Group::destroy($id);
        return Redirect::to('/settings');
    }
    public function postCreateRooms(Request $req)
    {
        $hostel = Auth::user()->hostel;
        $floorCount = $hostel->floors()->count();
        $blockCount = $req->input('block_count');
        $roomCount = $req->input('room_count');
        if (!$floorCount) {
            for ($number = 1; $number <= $floorCount; $number++) {
                Floor::create([
                    'number' => $number,
                    'hostel_id' => $hostel->id
                ]);
            }
        }
        $floors = Floor::all();
        foreach ($floors as $floor) {
            for ($number = 1; $number <= $blockCount; $number++) {
                Block::create([
                    'number' => $number,
                    'floor_id' => $floor->id
                ]);
            }
        }
        foreach ($floors as $floor) {
            foreach ($floor->blocks as $block) {
                for ($number = $roomCount * ($block->number-1) + 1; $number <= $roomCount * $block->number; $number++) {
                    Room::create([
                        'number' => $floor->number * 100 + $number,
                        'liver_max' => 4,
                        'area' => 40,
                        'block_id' => $block->id,
                    ]);
                }
            }
        }
        return Redirect::to('/settings');
    }
    public function getDeleteRooms()
    {
        $hostel = Auth::user()->hostel;
        foreach ($hostel->floors as $floor) {
            foreach ($floor->blocks as $block) {
                $block->rooms()->delete();
            }
            $floor->blocks()->delete();
        }
        return Redirect::to('/settings');
    }
    public function getEditRoom($id)
    {
        return view('setting.edit-room', ['room' => Room::find($id)]);
    }
    public function postEditRoom(Request $req)
    {
        $room = Room::find($req->input('id'));
        $room->number = $req->input('number');
        $room->liver_max = $req->input('liver_max');
        $room->block = $req->input('block');
        $room->area = $req->input('area');
        $room->save();
        return Redirect::to('/settings');
    }
    public function getDeleteRoom($id)
    {
        Room::destroy($id);
        return Redirect::to('/settings');
    }
}
