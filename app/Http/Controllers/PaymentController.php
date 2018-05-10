<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Payment;
use App\Models\Room;
use App\Models\Liver;
use App\Models\Hostel;

class PaymentController extends Controller
{
    public function index()
    {
        $pays = Payment::all();
        return view('payment.index',['pays' => $pays]);
    }

    public function create()
    {
        return view('payment.create', ['blocks' => 5]);
    }
    private function blockLiversCount($block) {
        return Room::where('block', '=', $block)->sum('liver_max');
    }

    public function store(Request $req)
    {
        $watchman = $req->user()->profile;
        $hostelArea = $watchman->hostel->area;
        $livers = Liver::all();
        foreach ($livers as &$liver) {
            $blockLiversCount = $this->blockLiversCount($liver->room->block);
            $gPrice = $req->input('gas_price')/$hostelArea*$liver->room->area;
            $ePrice = $req->input('elec_price_'.$liver->room->block) / $blockLiversCount;
            $wPrice = $req->input('water_price_'.$liver->room->block) / $blockLiversCount;
            $watchman->payments()->create([
                'liver_id' => $liver->id,
                'date' => date('Y-m-d'),
                'live_price' => $req->input('live_price'),
                'g_price' => $gPrice,
                'e_price' => $ePrice,
                'w_price' => $wPrice,
            ]);
        }
        return redirect()->route('payments.index');
    }
    public function getLivers($date)
    {
        $pays = Payment::where('date','=',$date)->get();
        return view('payment.livers', ['pays' => $pays]);
    }
    public function getPaid($id)
    {
        $pay = Payment::find($id);
        $liver = Liver::find($pay->liver->id);
        $liver->balance += $pay->total;
        $liver->save();
        $pay->paid = $pay->total;
        $pay->save();
        return Redirect::to('/payments/livers/'.$pay->date);
    }
}
