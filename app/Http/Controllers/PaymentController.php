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
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    public function autocomplete(Request $request, Payment $payment)
    {
        $term = $request->get('term');
        $payment = Payment::find($request->get('payment'));
        $paid = $request->get('paid');
        $livers = $payment->livers()
            ->wherePivot('paid', $paid ? '<>' : '=' , null)
            ->where('last_name', 'LIKE', "%$term%")
            ->orWhere('first_name', 'LIKE', "%$term%")
            ->orWhere('second_name', 'LIKE', "%$term%")
            ->get();
        $results = array();
        foreach ($livers as $liver)
        {
            $results[] = [ 'id' => $liver->id, 'value' => $liver->full_name()];
        }
        return Response::json($results);
    }

    public function index(Request $request)
    {
        $hostels = Hostel::all();
        $currentHostel = $request->get('hostel')
            ? Hostel::find($request->get('hostel'))
            : $hostels->first();
        $payments = $currentHostel->payments();
        $q = $request->get('q');
        if ($q) {
            $payments = $payments->where('date', '=', $q);
        }
        $payments = $payments->paginate(config('app.paginated_by'));
        return view('payment.index', compact('payments', 'hostels', 'currentHostel', 'q'));
    }

    public function show(Request $request, Payment $payment)
    {
        $hostels = Hostel::all();
        $currentHostel = $request->get('hostel')
            ? Hostel::find($request->get('hostel'))
            : $hostels->first();
        $paid = $request->get('paid');
        if ($paid == null) $paid = true;
        if ($request->get('q'))
            $livers = $payment->livers()->whereId($request->get('q'))->paginate(config('app.paginated_by'));
        else
            $livers = $payment->livers()->paginate(config('app.paginated_by'));
        return view('payment.show', compact('livers', 'payment', 'paid', 'hostels', 'currentHostel'));
    }
}
