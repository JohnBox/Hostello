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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $blocksCount = Room::all()->groupBy('block')->count();
        $pays = DB::table('pays')->select(DB::raw('SUM(live_price) as live_price,
                                                                 SUM(gas_price) as gas_price,
                                                                 SUM(elec_price) as elec_price,
                                                                 SUM(water_price) as water_price,
                                                                 SUM(total) as total,
                                                                 SUM(paid) as paid,
                                                                date'))->groupBy('date')->get();
        return view('payment.index',['pays' => $pays, 'blocks' => $blocksCount]);
    }
    private function blockLiversCount($block) {
        return Room::where('block', '=', $block)->sum('liver_max');
    }

    public function postCreate(Request $req)
    {
        $hostelArea = $req->user()->hostel->area;
        $livers = Liver::all();
        foreach ($livers as &$liver) {
            $blockLiversCount = $this->blockLiversCount($liver->room->block);
            $gasPrice = $req->input('gas_price')/$hostelArea*$liver->room->area;
            $elecPrice = $req->input('elec_price_'.$liver->room->block) / $blockLiversCount;
            $waterPrice = $req->input('water_price_'.$liver->room->block) / $blockLiversCount;
            $pay = Pay::create([
                'liver_id' => $liver->id,
                'date' => date('Y-m-d'),
                'live_price' => $req->input('live_price'),
                'gas_price' => $gasPrice,
                'elec_price' => $elecPrice,
                'water_price' => $waterPrice,
                'total' => $gasPrice + $elecPrice + $waterPrice
            ]);
            $liver->balance -= $pay->total;
            $liver->save();

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
        $pay = Pay::find($id);
        $liver = Liver::find($pay->liver->id);
        $liver->balance += $pay->total;
        $liver->save();
        $pay->paid = $pay->total;
        $pay->save();
        return Redirect::to('/payments/livers/'.$pay->date);
    }
}
