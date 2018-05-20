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
    public function index()
    {
        return view('payment.index', ['payments' => Payment::paginate(config('app.paginated_by'))]);
    }

    public function autocomplete(Request $request, Payment $payment)
    {
        $term = $request->get('term');
        $livers = Liver::query()
            ->where('last_name', 'LIKE', "%$term%")
            ->orWhere('first_name', 'LIKE', "%$term%")
            ->orWhere('second_name', 'LIKE', "%$term%")
            ->take(5)->get();
        $results = array();
        foreach ($livers as $liver)
        {
            $results[] = [ 'id' => $liver->id, 'value' => $liver->full_name()];
        }
        return Response::json($results);
    }

    public function show(Request $request, Payment $payment)
    {
        if ($request->get('q'))
            $livers = $payment->livers()->whereId($request->get('q'))->paginate(config('app.paginated_by'));
        else
            $livers = $payment->livers()->paginate(config('app.paginated_by'));
        return view('payment.show', ['livers' => $livers, 'payment' => $payment]);
    }
}
