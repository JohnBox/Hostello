<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProfileController extends Controller
{
    function index(Request $request)
    {
        $profile = $request->user()->profile;
        $unpaidPayments = $profile->payments()->wherePivot('paid', null)->count();
        $unpaidViolations = $profile->violations()->wherePivot('paid', null)->count();
        $page = 'index';
        return view('profile.index', compact('profile', 'page', 'unpaidPayments', 'unpaidViolations'));
    }

    function payments(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'payments';
        $unpaid = (boolean)count($profile->payments()->wherePivot('paid', null)->get());
        return view('profile.payments', compact('profile', 'page', 'unpaid'));
    }

    function violations(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'violations';
        $unpaid = (boolean)count($profile->violations()->wherePivot('paid', null)->get());
        return view('profile.violations', compact('profile', 'page', 'unpaid'));
    }

    function injections(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'injections';
        return view('profile.injections', compact('profile', 'page'));
    }

    function ejections(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'ejections';
        return view('profile.ejections', compact('profile', 'page'));
    }

    function payPayment(Request $request)
    {
        $liver = $request->user()->profile;
        $pivot = $liver->payments->find($request->get('payment'))->pivot;
        $pivot->paid = date('Y-m-d');
        $pivot->save();
        $liver->balance += $pivot->price;
        $liver->save();
        return redirect()->route('profile.payments');
    }

    function payAllPayments(Request $request)
    {
        $liver = $request->user()->profile;
        foreach($liver->payments as $payment) {
            if (!$payment->pivot->paid) {
                $payment->pivot->paid = date('Y-m-d');
                $payment->pivot->save();
                $liver->balance += $payment->pivot->price;
                $liver->save();
            }
        };
        return redirect()->route('profile.payments');
    }

    function payViolation(Request $request)
    {
        $liver = $request->user()->profile;
        $pivot = $liver->violations->find($request->get('violation'))->pivot;
        $pivot->paid = date('Y-m-d');
        $pivot->save();
        $liver->balance += $pivot->price;
        $liver->save();
        return redirect()->route('profile.violations');
    }

    function payAllViolations(Request $request)
    {
        $liver = $request->user()->profile;
        foreach($liver->violations as $violation) {
            if (!$violation->pivot->paid) {
                $violation->pivot->paid = date('Y-m-d');
                $violation->pivot->save();
                $liver->balance += $violation->pivot->price;
                $liver->save();
            }
        };
        return redirect()->route('profile.violations');
    }
}
