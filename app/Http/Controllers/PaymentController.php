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
        return view('payment.index', ['payments' => Payment::all()]);
    }


    public function show(Payment $payment)
    {
        return view('payment.show', ['payment' => $payment]);
    }
}
