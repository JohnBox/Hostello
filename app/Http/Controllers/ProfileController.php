<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;


class ProfileController extends Controller
{
    function index(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'index';
        return view('profile.index', compact('profile', 'page'));
    }

    function payments(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'payments';
        return view('profile.payments', compact('profile', 'page'));
    }

    function violations(Request $request)
    {
        $profile = $request->user()->profile;
        $page = 'violations';
        return view('profile.violations', compact('profile', 'page'));
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

    function pay()
    {

        $data = <<<DATA
<oper>cmt</oper>
<wait>0</wait>
<test>1</test>
<payment id="1234567">
<prop name="b_card_or_acc" value="5158755620903928" />
<prop name="amt" value="1" />
<prop name="ccy" value="UAH" />
<prop name="details" value="test%20merch%20not%20active" />
</payment>
DATA;

        $password = '5ULqSVyyBNpv78552krrQainPiGo118w';
        $sign = sha1(md5($data.$password));

        $xml = <<<REQ
<?xml version="1.0" encoding="UTF-8"?>
<request version="1.0">
<merchant>
<id>136038</id>
<signature>$sign</signature>
</merchant>
<data>
$data
</data>
</request>
REQ;
        $url = 'https://api.privatbank.ua/p24api/pay_pb';
        $client = new Client();
        $req = new GuzzleRequest('POST', $url, ['Content-Type' => 'text/xml; charset=UTF8'], $xml);
        $res = $client->send($req);
        var_dump($res);
    }
}
