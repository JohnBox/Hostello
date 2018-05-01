<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Liver;

class ReportController extends Controller
{
    public function getIndex()
    {
        $livers = Liver::where('balance','<','0.0')->get();
        $total = 0;
        foreach ($livers as $l) {
            $total+=$l->balance;
        }

        return view('report.index', ['livers' => $livers, 'total' => (float)$total]);
    }
}
