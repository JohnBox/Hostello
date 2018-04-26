<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Pay;
use App\Models\Room;
use App\Models\Liver;
use App\Models\Hostel;

class PaymentController extends Controller
{
    public function getIndex()
    {
        $bc = Room::all()->groupBy('block')->count();
        $pays = DB::table('pays')->select(DB::raw('SUM(live_price) as live_price,
     SUM(gas_price) as gas_price,
     SUM(elec_price) as elec_price,
     SUM(water_price) as water_price,
     SUM(total) as total,
     SUM(paid) as paid,
     date'))->groupBy('date')->get();
        return view('payment.index',['pays' => $pays, 'bc' => $bc]);
    }
    public function postCreate(Request $req)
    {
        $blc = [];
        $bc = Room::all()->groupBy('block')->count();
        for ($i=0;$i<$bc;$i++) {
            $blc[]=0;
        }
        for ($i=0;$i<$bc;$i++) {
            $block = Room::where('block', '=', $i)->get();
            foreach ($block as $room) {
                $blc[$i] += $room->livers->count();
            }
        }
        $h = Hostel::find(Auth::user()->hostel_id);
        foreach (Liver::all() as &$l) {
            $p = Pay::create([
                'liver_id' => $l->id,
                'date' => date("Y-m-d", strtotime($req->input('date'))),
                'live_price' => $req->input('live_price'),
                'gas_price' => ($req->input('gas_price')/$h->area)*$l->room->area,
                'elec_price' => ($req->input('elec_price_'.($l->room->block-1))/($blc[$l->room->block-1])),
                'water_price' => ($req->input('water_price_'.($l->room->block-1))/($blc[$l->room->block-1])),
                'total' =>
                    ($req->input('gas_price')/$h->area)*$l->room->area+
                    ($req->input('elec_price_'.$l->room->block)/$blc[$l->room->block])+
                    ($req->input('water_price_'.$l->room->block)/$blc[$l->room->block])
            ]);
            $l->balance -= $p->total;
            $l->save();

        }
        return Redirect::to('/payments');
    }
    public function getLivers($date)
    {
        $pays = Pay::where('date','=',$date)->get();
        return view('payment.livers', ['pays' => $pays]);
    }
    public function getPaid($id)
    {
        $p = Pay::find($id);
        $l = Liver::find($p->liver->id);
        $l->balance += $p->total;
        $l->save();
        $p->paid = $p->total;
        $p->save();
        return Redirect::to('/payments/livers/'.$p->date);
    }
}
