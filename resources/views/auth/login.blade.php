@extends('layouts.app')

@section('nav')
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/') }}">Гуртожиток</a>
    </div>
@endsection

@section('content')
    <section id="intro">
        <div id="Sahtesahne">
            <div id="sahne">
                <div id="ev">
                    <div class="yuz sol"><div></div></div>
                    <div class="yuz on"><div></div></div>
                    <div class="yuz sag"></div>
                    <div class="yuz arka"><div></div></div>
                    <div class="yuz alt"></div>
                </div>

                <div class="cali"></div>
                <div class="agac ufak"></div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Авторизація</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Помилки введення<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Логін</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Пароль</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Запам’ятати мене
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">Війти</button>

                                    <a class="btn btn-link" href="{{ url('/password/email') }}">Забули пароль?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <style>
        /*
        Start   :   CSS Reset
        This CSS Reset part is from Eric Meyer
        http://meyerweb.com/eric/tools/css/reset/
        v2.0 | 20110126
        License: none (public domain)
    */

        @import url(http://fonts.googleapis.com/css?family=Montserrat);

        html, body, div, span, applet, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        a, abbr, acronym, address, big, cite, code,
        del, dfn, em, img, ins, kbd, q, s, samp,
        small, strike, strong, sub, sup, tt, var,
        b, u, i, center,
        dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend,
        table, caption, tbody, tfoot, thead, tr, th, td,
        article, aside, canvas, details, embed,
        figure, figcaption, footer, header, hgroup,
        menu, nav, output, ruby, section, summary,
        time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }
        /* HTML5 display-role reset for older browsers */
        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block;
        }
        body {
            line-height: 1;
        }
        ol, ul {
            list-style: none;
        }
        blockquote, q {
            quotes: none;
        }
        blockquote:before, blockquote:after,
        q:before, q:after {
            content: '';
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /*
            End  :   CSS Reset
        */

        /* Not Optimised or fully tested on Internet Explorer!   */

        /* Vuhuuu WebKit */
        .noTransition *:not(#isler):not(.kat) {
            -webkit-transition: none !important;
            -moz-transition: none !important;
            transition: none !important;
        }
        /* Vuhuuu WebKit: */
        @-webkit-keyframes ev-on {
            from { -webkit-transform: translateZ(136px) rotateX(-20deg); transform: translateZ(136px) rotateX(-20deg); }
            to { -webkit-transform: translateZ(136px); transform: translateZ(136px); }
        }
        @-moz-keyframes ev-on {
            from { -moz-transform: translateZ(136px) rotateX(-20deg); }
            to { -moz-transform: translateZ(136px); }
        }
        @keyframes ev-on {
            from { -moz-transform: translateZ(136px) rotateX(-20deg); transform: translateZ(136px) rotateX(-20deg); }
            to { -moz-transform: translateZ(136px); transform: translateZ(136px); }
        }
        @-webkit-keyframes ev-arka {
            from { -webkit-transform: translateZ(-136px) rotateX(20deg); transform: translateZ(-136px) rotateX(20deg); }
            to { -webkit-transform: translateZ(-136px); transform: translateZ(-136px); }
        }
        @-moz-keyframes ev-arka {
            from { -moz-transform: translateZ(-136px) rotateX(20deg); }
            to { -moz-transform: translateZ(-136px); }
        }
        @keyframes ev-arka {
            from { -moz-transform: translateZ(-136px) rotateX(20deg); transform: translateZ(-136px) rotateX(20deg); }
            to { -moz-transform: translateZ(-136px); transform: translateZ(-136px); }
        }
        @-webkit-keyframes ev-sag {
            from { -webkit-transform: translateX(136px) rotateY(90deg) rotateX(-20deg); transform: translateX(136px) rotateY(90deg) rotateX(-20deg); }
            to { -webkit-transform: translateX(136px) rotateY(90deg); transform: translateX(136px) rotateY(90deg); }
        }
        @-moz-keyframes ev-sag {
            from { -moz-transform: translateX(136px) rotateY(90deg) rotateX(-20deg); }
            to { -moz-transform: translateX(136px) rotateY(90deg); }
        }
        @keyframes ev-sag {
            from { -moz-transform: translateX(136px) rotateY(90deg) rotateX(-20deg); transform: translateX(136px) rotateY(90deg) rotateX(-20deg); }
            to { -moz-transform: translateX(136px) rotateY(90deg); transform: translateX(136px) rotateY(90deg); }
        }
        @-webkit-keyframes ev-sol {
            from { -webkit-transform: translateX(-136px) rotateY(90deg) rotateX(20deg); transform: translateX(-136px) rotateY(90deg) rotateX(20deg); }
            to { -webkit-transform: translateX(-136px) rotateY(90deg); transform: translateX(-136px) rotateY(90deg); }
        }
        @-moz-keyframes ev-sol {
            from { -moz-transform: translateX(-136px) rotateY(90deg) rotateX(20deg); }
            to { -moz-transform: translateX(-136px) rotateY(90deg); }
        }
        @keyframes ev-sol {
            from { -moz-transform: translateX(-136px) rotateY(90deg) rotateX(20deg); transform: translateX(-136px) rotateY(90deg) rotateX(20deg); }
            to { -moz-transform: translateX(-136px) rotateY(90deg); transform: translateX(-136px) rotateY(90deg); }
        }
        @-webkit-keyframes ev-kulak-on {
            from { -webkit-transform: rotateY(0); transform: rotateY(0); }
            to { -webkit-transform: rotateY(90deg); transform: rotateY(90deg); }
        }
        @-moz-keyframes ev-kulak-on {
            from { -moz-transform: rotateY(0); }
            to { -moz-transform: rotateY(90deg); }
        }
        @keyframes ev-kulak-on {
            from { -moz-transform: rotateY(0); transform: rotateY(0); }
            to { -moz-transform: rotateY(90deg); transform: rotateY(90deg); }
        }
        @-webkit-keyframes ev-kulak-sol {
            from { -webkit-transform: rotateY(-180deg); transform: rotateY(-180deg); }
            to { -webkit-transform: rotateY(-90deg); transform: rotateY(-90deg); }
        }
        @-moz-keyframes ev-kulak-sol {
            from { -moz-transform: rotateY(-180deg); }
            to { -moz-transform: rotateY(-90deg); }
        }
        @keyframes ev-kulak-sol {
            from { -moz-transform: rotateY(-180deg); transform: rotateY(-180deg); }
            to { -moz-transform: rotateY(-90deg); transform: rotateY(-90deg); }
        }
        @-webkit-keyframes menu-giris {
            from { top:-50px; }
            to { top:60px; }
        }
        @-moz-keyframes menu-giris {
            from { top:-50px; }
            to { top:60px; }
        }
        @keyframes menu-giris {
            from { top:-50px; }
            to { top:60px; }
        }
        @-webkit-keyframes soldan-giris {
            from { margin-left:-140px; opacity: 0; }
            to { margin-left:0px; opacity: 1; }
        }
        @-moz-keyframes soldan-giris {
            from { margin-left:-140px; opacity: 0; }
            to { margin-left:0px; opacity: 1; }
        }
        @keyframes soldan-giris {
            from { margin-left:-140px; opacity: 0; }
            to { margin-left:0px; opacity: 1; }
        }
        html, body {
            height: 100%;
            min-width: 320px;
        }
        body {
            font-size: 12px;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            line-height: 18px;
            color: #c4b9ae;
        }
        h1 {
            font-size: 24px;
            padding: 10px 0 20px;
            text-align: center;
            color: #6d6a76;
        }
        h2 {
            font-size: 38px;
        }
        h3 {
            font-size: 28px;
            line-height: 32px;
            color: #fff;
        }
        h4 {
            font-size: 18px;
            line-height: 30px;
            color: #a1b3d4;
        }
        h5 {
            font-size: 17px;
            line-height: 20px;
            color: #484651;
        }
        a:link {
            color:#01ADD0;
            text-decoration: none;
        }
        a:visited {
            color:#01ADD0;
        }
        .ara {
            height: 200px;
            background: #3a67af url(http://siis.com.tr/cp/evler.png) repeat-x bottom center;
        }
        .agac {
            width: 172px;
            height: 230px;
            position: absolute;
            left: 8%;
            margin-top: 10px;
            background: url(http://siis.com.tr/cp/agac.png) no-repeat center;
            background-size: 100% auto;
        }
        .agac.ufak {
            left: 0;
            width: 160px;
            height: 213px;
            margin: 0 0 -20px 170px;
            -webkit-transform: translate3d(-90px, -80px, 300px) scale(.7);
            transform:none;
        }
        .cali {
            bottom: 25%;
            position: absolute;
            height: 60px;
            width: 166px;
            background: url(http://siis.com.tr/cp/cali.png) no-repeat center;
            background-size: 100% auto;
            margin: 0 0 -25px -320px;
            z-index: 9;
        }
        #ust {
            position: absolute;
            width: 100%;
            min-width: 320px;
        }
        #ust > .logo {
            position: relative;
            z-index: 20;
            float: left;
            width: 130px;
            height: 72px;
            max-width: 130px;
            max-height: 72px;
            left: 15%;
            top: 50px;
        }
        .logo > img {
            width: 100%;
            height: auto;
        }
        #menu {
            position: fixed;
            width: 550px;
            height: 36px;
            line-height: 36px;
            top: -50px;
            z-index: 20;
            background: #cc3e4f;
            border-radius: 18px 1px 18px 1px;
            box-shadow: -7px 8px 0 rgba(0,0,0,.2);
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            -webkit-transition: .2s ease-out;
            -moz-transition: .2s ease-out;
            transition: .2s ease-out;
            -webkit-transition-property: right, left;
            -moz-transition-property: right, left;
            transition-property: right, left;
        }
        #menu.anim {
            -webkit-animation: menu-giris .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: menu-giris .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: menu-giris .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        #menu.acik {
            right: 15%;
        }
        #menu.kapali {
            top: 20px;
            right: -500px;
            -webkit-transition-property: right, top, left;
            -moz-transition-property: right, top, left;
            transition-property: right, top, left;
        }
        #menu.zorlaKapali {
            right: -500px;
        }
        #menu.zorlaAcik {
            right: 15%;
            -webkit-transition: .2s ease-out;
            -moz-transition: .2s ease-out;
            transition: .2s ease-out;
            -webkit-transition-property: right, top, left;
            -moz-transition-property: right, top, left;
            transition-property: right, top, left;
        }

        #menu div {
            width: 36px;
            height: 36px;
            display: block;
            float: left;
            cursor: pointer;
        }
        #menu i {
            float: left;
            width: 9px;
            height: 9px;
            background: #fff;
            line-height: 36px;
            margin: 14px 24px 0 18px;
            -webkit-transition: .2s ease-out;
            -moz-transition: .2s ease-out;
            transition: .2s ease-out;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        #menu div:hover i {
            background: #ffb30b;
        }
        #menu li {
            float: left;
            font-size: 14px;
            margin: 0 10px;
        }
        #menu a:link {
            display: block;
            color: #fff;
            padding: 0 6px;
            text-decoration: none;
            box-sizing: border-box;
            height: 36px;
            border-bottom:0px solid #fff;
            -webkit-transition: .2s ease-out;
            -moz-transition: .2s ease-out;
            transition: .2s ease-out;
            -webkit-transition-property: border-bottom, color;
            -moz-transition-property: border-bottom, color;
            transition-property: border-bottom, color;
        }
        #menu a:visited {
            color: #fff;
        }
        #menu a:hover {
            color: #ffb30b;
            border-bottom: 4px solid #ffb30b;
        }

        #intro {
            left: 0;
            top: 0;
            height: 89vh;
            position: absolute;
            background: transparent;
            z-index: 0;
            overflow: hidden;
        }
        #intro > header {
            position: absolute;
            left:15%;
            bottom: 25%;
            z-index: 15;
        }
        header h3 {
            -webkit-animation: soldan-giris .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: soldan-giris .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: soldan-giris .6s ease-out .3s;
            animation-fill-mode: forwards;
            margin-left:-140px;
            opacity: 0;
        }
        header h4 {
            -webkit-animation: soldan-giris .6s ease-out .5s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: soldan-giris .6s ease-out .5s;
            -moz-animation-fill-mode: forwards;
            animation: soldan-giris .6s ease-out .5s;
            animation-fill-mode: forwards;
            margin-left:-140px;
            opacity: 0;
        }
        #ok {
            width: 23px;
            height: 20px;
            background: url(http://siis.com.tr/cp/ok.png) no-repeat center center;
            cursor: pointer;
            left: 49%;
            position: relative;
            bottom: 5%;
        }
        #intro .agac {
            bottom: 10%;
            z-index: 11;
        }
        #Sahtesahne {
            width: 1140px;
            min-width: 450px;
            height: 100%;
            margin:auto;
            position: relative;
        }
        #sahne {
            width: 0px;
            position: absolute;
            height: 100%;
            left: 67%;
            -webkit-perspective: 1000px;
            -moz-perspective: 1000px;
            perspective: 1000px;
            -webkit-transform: scale(.8) translateY(130px);
            -moz-transform: scale(.8) translateY(130px);
            transform: scale(.8) translateY(130px);
            -webkit-transition: .2s ease-out;
            -webkit-transition-property: transform, left;
            -moz-transition: .2s ease-out;
            -moz-transition-property: transform, left;
            transition: .2s ease-out;
            transition-property: transform, left;
        }
        #ev {
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transform: translateY(0) rotateY(-47deg);
            -moz-transform: translateY(0) rotateY(-47deg);
            transform: translateY(0) rotateY(-47deg);
            position: absolute;
            bottom: 25%;
            height: 450px;
        }
        .yuz {
            width: 272px;
            height: 450px;
            background: rgba(255,255,255,1);
            position: absolute;
            text-align: center;
            line-height: 200px;
            z-index: 10;
            background-color: #d1cdc9;
            background-repeat: no-repeat;
            background-size: auto 100%;
            -webkit-transform-origin: 50% 100%;
            -moz-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
            box-sizing:border-box;
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }
        .yuz > div {
            position: absolute;
            width: 16px;
            height: 450px;
            background-repeat: no-repeat;
            background-size: auto 100%;
            background-image: url(http://siis.com.tr/cp/ev.png);
            -webkit-transform-origin: 0% 0%;
            -moz-transform-origin: 0% 0%;
            transform-origin: 0% 0%;
            background-position: -74px 0;
        }
        .alt {
            background: #aa9f94;
            height: 272px;
            -webkit-transform: translateZ(136px) translateY(178px) rotateX(90deg);
            -moz-transform: translateZ(136px) translateY(178px) rotateX(90deg);
            transform: translateZ(136px) translateY(178px) rotateX(90deg);
        }
        .on {
            -webkit-transform: translateZ(136px) rotateX(-20deg);
            -moz-transform: translateZ(136px) rotateX(-20deg);
            transform: translateZ(136px) rotateX(-20deg);
            background-image: url(http://siis.com.tr/cp/ev.png);
            background-position: -124px 0px;
            -webkit-animation: ev-on .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-on .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-on .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .arka {
            -webkit-transform: translateZ(-136px) rotateX(20deg);
            -moz-transform: translateZ(-136px) rotateX(20deg);
            transform: translateZ(-136px) rotateX(20deg);
            -webkit-animation: ev-arka .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-arka .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-arka .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .sol {
            -webkit-transform: translateX(-136px) rotateY(90deg) rotateX(20deg);
            -moz-transform: translateX(-136px) rotateY(90deg) rotateX(20deg);
            transform: translateX(-136px) rotateY(90deg) rotateX(20deg);
            -webkit-animation: ev-sol .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-sol .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-sol .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .sag {
            -webkit-transform: translateX(136px) rotateY(90deg) rotateX(-20deg);
            -moz-transform: translateX(136px) rotateY(90deg) rotateX(-20deg);
            transform: translateX(136px) rotateY(90deg) rotateX(-20deg);
            background-image: url(http://siis.com.tr/cp/ev.png);
            background-position: -410px 0px;
            -webkit-animation: ev-sag .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-sag .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-sag .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .on>div {
            margin-left: 271px;
            -webkit-animation: ev-kulak-on .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-kulak-on .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-kulak-on .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .sol>div {
            margin-left: 1px;
            background-position: -74px 0;
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
            -webkit-animation: ev-kulak-sol .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-kulak-sol .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-kulak-sol .6s ease-out .3s;
            animation-fill-mode: forwards;
        }
        .arka>div {
            background-position: -74px 0;
            margin-left: 1px;
            -webkit-transform: rotateY(-180deg);
            -moz-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
            -webkit-animation: ev-kulak-sol .6s ease-out .3s;
            -webkit-animation-fill-mode: forwards;
            -moz-animation: ev-kulak-sol .6s ease-out .3s;
            -moz-animation-fill-mode: forwards;
            animation: ev-kulak-sol .6s ease-out .3s;
            animation-fill-mode: forwards;
        }

        #hakkinda, #projeler {
            padding: 60px 0;
            overflow: hidden;
        }
        #hakkinda > .tanitim {
            width: 90%;
            max-width: 1000px;
            font-size: 15px;
            margin: auto;
            text-align: center;
            margin-bottom: 20px;
        }
        #ortalama {
            width: 0;
            height: 500px;
            margin: auto;
        }
        #Sahteisler {
            margin-left: -570px;
            position: relative;
        }
        #isler {
            width: 1140px;
            height: 500px;
            margin: auto;
            font-size: 18px;
            -webkit-perspective: 1000px;
            -moz-perspective: 1000px;
            perspective: 1000px;
            perspective-origin:50% 130%;
            -webkit-transform: translateX(-12px) rotateZ(-5deg) scale(.8);
            -moz-transform: translateX(-12px) rotateZ(-5deg) scale(.8);
            transform: translateX(-12px) rotateZ(-5deg) scale(.8);
            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transition: transform .2s ease-out;
            -moz-transition: transform .2s ease-out;
            transition: transform .2s ease-out;
        }
        #isler > .kat {
            line-height: 26px;
            padding: 20px 10px;
            background: #e2dbd3;
            border-width: 20px 10px;
            float: left;
            position: relative;
            overflow: hidden;
            -webkit-transition: .2s ease-out;
            -webkit-transition-property: transform, background, width;
            -moz-transition: .2s ease-out;
            -moz-transition-property: transform, background, width;
            transition: .2s ease-out;
            transition-property: transform, background, width;
        }
        #isler > .kat, .kat > img {
            width: 350px;
            height: 460px;
        }
        .kat > .yazi {
            position: relative;
            width: 100%;
            color: #6d6a76;
            text-align: justify;
        }
        .kat > img {
            position: absolute;
            z-index: 12;
            -webkit-transition: opacity .2s ease-out;
            -moz-transition: opacity .2s ease-out;
            transition: opacity .2s ease-out;
        }
        .kat > h2 {
            position: absolute;
            z-index: 13;
            bottom: 15px;
            line-height: 46px;
            color: #f77f08;
        }
        #isler > .kat:nth-child(1) {
            padding-left: 20px;
            -webkit-transform: rotateY(-20deg) translateX(21px) translateZ(-9px);
            -moz-transform: rotateY(-20deg) translateX(21px) translateZ(-9px);
            transform: rotateY(-20deg) translateX(21px) translateZ(-9px);
        }
        #isler > .kat:nth-last-child(2) {
            background: #C9C2BB;
            -webkit-transform: rotateY(20deg);
            -moz-transform: rotateY(20deg);
            transform: rotateY(20deg);
        }
        #isler > .kat:nth-last-child(1) {
            padding-right: 20px;
            -webkit-transform: rotateY(-8deg) translateX(-18px) translateZ(-34px);
            -moz-transform: rotateY(-8deg) translateX(-18px) translateZ(-34px);
            transform: rotateY(-8deg) translateX(-18px) translateZ(-34px);
        }
        #isler.hover {
            -webkit-transform: translateX(-12px) rotateZ(-4deg) scale(.8);
            -moz-transform: translateX(-12px) rotateZ(-4deg) scale(.8);
            transform: translateX(-12px) rotateZ(-4deg) scale(.8);
        }
        #isler.hover > .kat:nth-child(1) {
            -webkit-transform: rotateY(-15deg) translateX(13px) translateZ(-4px);
            -moz-transform: rotateY(-15deg) translateX(13px) translateZ(-4px);
            transform: rotateY(-15deg) translateX(13px) translateZ(-4px);
        }
        #isler.hover > .kat:nth-child(2) {
            background: #CFC7C0;
            -webkit-transform: rotateY(15deg);
            -moz-transform: rotateY(15deg);
            transform: rotateY(15deg);
        }
        #isler.hover > .kat:nth-last-child(1) {
            -webkit-transform: rotateY(-5deg) translateX(-10px) translateZ(-28px) translateY(1px);
            -moz-transform: rotateY(-5deg) translateX(-10px) translateZ(-28px) translateY(1px);
            transform: rotateY(-5deg) translateX(-10px) translateZ(-28px) translateY(1px);
        }
        .kat:hover:not(.click) {
            cursor: pointer;
        }
        .kat.click > img {
            opacity: 0;
        }
        #isler.acik {
            -webkit-transform: scale(.8) !important;
            -moz-transform: scale(.8) !important;
            transform: scale(.8) !important;
        }
        #isler.acik > .kat {
            background: #e2dbd3 !important;
            -webkit-transform: none !important;
            -moz-transform: none !important;
            transform: none !important;
        }

        #projeListe {
            margin: auto;
            width: 1090px;
        }
        #projeListe > li {
            width: 350px;
            height: 300px;
            margin: 10px;
            float: left;
            text-align: center;
            background: #c4b9ae;
            overflow: hidden;
            border-bottom: 0px solid #484651;
            box-sizing: border-box;
            -webkit-transition: border .2s ease-out;
            -moz-transition: border .2s ease-out;
            transition: border .2s ease-out;
        }
        #projeListe > li:hover {
            border-bottom: 8px solid #484651;
            cursor: pointer;
        }
        #projeListe > li > .img {
            overflow: hidden;
            width: 330px;
            height: 230px;
            margin: 10px auto;
            position: relative;
            margin-bottom: 10px !important;
        }
        #projeListe > li img {
            position: absolute;
            min-height: 100%;
            min-width: 100%;
            top: -100%;
            bottom: -100%;
            left: -100%;
            right: -100%;
            margin: auto;
        }
        #projeListe p {
            color: #484651;
            margin-bottom:12px;
        }
        footer {
            background: #484651;
        }
        footer > section {
            max-width: 1140px;
            height: auto;
            padding: 50px 10px;
            color: #fff;
            margin: auto;
        }
        #iletisim {
            text-align: center;
            line-height: 0;
        }
        #iletisim > div, #iletisim > ul {
            vertical-align: middle;
            display: inline-block;
            clear: both;
            width: 230px;
            height: 60px;
            margin-right: 10px;
            margin-left: 10px;
        }
        #iletisim > div {
            font-size: 12px;
            color: #fff;
        }
        #iletisim > div > div {
            line-height: 20px;
            margin-left: 15px;
            margin-top: 10px;
            max-width: 174px;
            text-align:left;
            float: left;
            overflow: hidden;
        }
        #iletisim div > i {
            float: left;
            width: 56px;
            height: 60px;
            background-repeat: no-repeat;
            background-size: auto 57px;
            background-image: url(http://siis.com.tr/cp/footerikon.png);
        }
        .tel > i {background-position: 2px 3px;}
        .adres > i {background-position: -58px 1px; width: 40px !important;}
        .eposta > i {background-position: -112px 2px;}
        .adres > div {
            margin-left: 10px !important;
        }
        .eposta > div {
            line-height: 40px !important;
        }
        #iletisim > .sosyal {
            width: 330px;
            text-align: center;
            font-size: 0;
        }
        .sosyal > li {
            display: inline-block;
            width: 43px;
            height: 43px;
            margin: 8px 2px;
            background-repeat: no-repeat;
            background-size: auto 56px;
            background-image: url(http://siis.com.tr/cp/footerikon.png);
        }
        .sosyal > li:nth-child(1) {
            margin-left: 0;
        }
        .sosyal > li:nth-last-child(1) {
            margin-right: 0;
        }
        .sosyal > li > a {
            display: block;
            height: 100%;
            border-radius: 100%;
        }
        .sosyal > li > a:hover {
            background: rgba(255,255,255,.15);
        }
        .sosyal > li > a:active {
            background: rgba(0,0,0,.15);
        }
        li.fb {background-position: -172px -4px;}
        li.vm {background-position: -220px -4px;}
        li.tw {background-position: -268px -4px;}
        li.gp {background-position: -315px -4px;}
        li.in {background-position: -363px -4px;}
        li.pi {background-position: -411px -4px;}
        li.yt {background-position: -458px -4px;}
        .imza {
            background: #fff;
            color: #000;
            font-size: 12px;
            line-height: 12px;
            text-align: center;
            padding: 18px;
        }



        @media screen and (min-height: 890px) {
            #sahne {
                -webkit-transform: scale(.8) translateY(-20px);
                -moz-transform: scale(.8) translateY(-20px);
                transform: scale(.8) translateY(-20px);
            }
            #intro > header {
                bottom: 40%;
            }
        }
        @media screen and (max-height: 670px) {
            #sahne {
                -webkit-transform: scale(.7) translateY(150px);
                -moz-transform: scale(.7) translateY(150px);
                transform: scale(.7) translateY(150px);
            }
        }
        @media screen and (max-height: 580px) {
            #sahne {
                -webkit-transform: scale(.6) translateY(170px);
                -moz-transform: scale(.6) translateY(170px);
                transform: scale(.6) translateY(170px);
            }
        }
        @media screen and (max-height: 500px) {
            #sahne {
                -webkit-transform: scale(.5) translateY(220px);
                -moz-transform: scale(.5) translateY(220px);
                transform: scale(.5) translateY(220px);
            }
        }
        @media screen and (max-height: 420px) {
            #sahne {
                -webkit-transform: scale(.4) translateY(260px);
                -moz-transform: scale(.4) translateY(260px);
                transform: scale(.4) translateY(260px);
            }
        }

        @media screen and (min-width: 1550px) {
            #menu.kapali, #menu.zorlaKapali {
                right: -505px;
            }
            #ortalama {
                height: 550px;
            }
            #Sahteisler {
                margin-top: 50px;
                margin-bottom: 50px;
            }
            #projeListe {
                width: 1540px;
            }
            #projeListe > li {
                width: 370px;
                height: 316px;
                margin: 10px;
            }
            #projeListe > li > .img {
                width: 350px;
                margin: 10px auto;
                height: 240px;
            }
            #projeListe > li:nth-child(5n), #projeListe > li:nth-child(1) {
                margin-left: 0;
            }
            #projeListe > li:nth-child(4n) {
                margin-right: 0;
            }
        }
        @media screen and (max-width: 1549px) and (min-width: 1141px)  {
            #projeListe > li:nth-child(4n), #projeListe > li:nth-child(1) {
                margin-left: 0;
            }
            #projeListe > li:nth-child(3n) {
                margin-right: 0;
            }
        }
        @media screen and (max-width: 1140px) {
            #menu {
                width: 520px;
            }
            #menu li {
                margin: 0 7px;
            }
            #menu.acik {
                right: 30px;
            }
            #menu.kapali, #menu.zorlaKapali {
                right: -480px;
            }
            #menu.zorlaAcik {
                right: 30px;
            }
            h3 {
                font-size: 20px;
                line-height: 30px;
            }
            h4 {
                font-size: 20px;
                line-height: 28px;
            }
            #Sahtesahne {
                width: 100%;
            }
            #ortalama {
                height: 450px;
            }
            #Sahteisler {
                margin-top: -40px;
                margin-bottom: -40px;
            }
            #isler {
                -webkit-transform: translateX(-12px) rotateZ(-5deg) scale(.7);
                -moz-transform: translateX(-12px) rotateZ(-5deg) scale(.7);
                transform: translateX(-12px) rotateZ(-5deg) scale(.7);
            }
            #isler.hover {
                -webkit-transform: translateX(-12px) rotateZ(-4deg) scale(.7);
                -moz-transform: translateX(-12px) rotateZ(-4deg) scale(.7);
                transform: translateX(-12px) rotateZ(-4deg) scale(.7);
            }
            #isler.acik {
                -webkit-transform: scale(.7) !important;
                -moz-transform: scale(.7) !important;
                transform: scale(.7) !important;
            }
            #projeListe {
                width: 720px;
            }
            #projeListe > li:nth-child(3n), #projeListe > li:nth-child(1) {
                margin-left: 0;
            }
            #projeListe > li:nth-child(2n) {
                margin-right: 0;
            }
            #iletisim > div, #iletisim > ul {
                width: 240px;
                margin-right: 15px;
                margin-left: 15px;
            }
            #iletisim > .sosyal {
                width: 330px;
                margin-top: 30px;
            }
        }
        @media screen and (max-width: 880px) {
            #sahne {
                -webkit-transform: scale(.7) translateY(150px) translateX(-100px);
                -moz-transform: scale(.7) translateY(150px) translateX(-100px);
                transform: scale(.7) translateY(150px) translateX(-100px);
            }
            h3 {
                font-size: 17px;
                line-height: 26px;
            }
            h4 {
                font-size: 17px;
                line-height: 23px;
            }
            #ust > .logo {
                left: 30px;
                max-height: 56px;
                max-width: 100px;
            }
            #intro > header {
                bottom: 10%;
            }
            #ortalama {
                height: 420px;
            }
            #Sahteisler {
                margin-top: -80px;
                margin-bottom: -80px;
            }
            #isler {
                -webkit-transform: translateX(-12px) rotateZ(-5deg) scale(.6);
                -moz-transform: translateX(-12px) rotateZ(-5deg) scale(.6);
                transform: translateX(-12px) rotateZ(-5deg) scale(.6);
            }
            #isler.hover {
                -webkit-transform: translateX(-12px) rotateZ(-4deg) scale(.6);
                -moz-transform: translateX(-12px) rotateZ(-4deg) scale(.6);
                transform: translateX(-12px) rotateZ(-4deg) scale(.6);
            }
            #isler.acik {
                -webkit-transform: scale(.6) !important;
                -moz-transform: scale(.6) !important;
                transform: scale(.6) !important;
            }
            #isler.acik > .kat.click {
                font-size: 20px !important;
            }
            #projeListe {
                width: 680px;
            }
            #projeListe > li {
                width: 320px;
                height: 274px;
            }
            #projeListe > li > .img {
                width: 300px;
                margin: 10px auto;
                height: 200px;
            }
            #iletisim > div, #iletisim > ul {
                width: 210px;
                margin-right: 5px;
                margin-left: 5px;
            }
            #iletisim > .sosyal {
                width: 330px;
                margin-top: 10px;
            }
            .adres > div {
                margin-left: 3px !important;
                max-width: 167px !important;
            }
            .eposta > div {
                margin-left: 3px !important;
                max-width: 167px !important;
            }
        }
        @media screen and (max-width: 700px) {
            #sahne {
                -webkit-transform: scale(.6) translateY(170px) translateX(-100px);
                -moz-transform: scale(.6) translateY(170px) translateX(-100px);
                transform: scale(.6) translateY(170px) translateX(-100px);
            }
            #ok {
                bottom:16%;
            }
            #ust > .logo {
                top: 130px;
                left: 15%;
            }
            #intro > header {
                bottom: 2%;
            }
            #ortalama {
                height: 380px;
            }
            #Sahteisler {
                margin-top: -100px;
                margin-bottom: -100px;
            }
            #isler {
                -webkit-transform: translateX(-12px) rotateZ(-5deg) scale(.5);
                -moz-transform: translateX(-12px) rotateZ(-5deg) scale(.5);
                transform: translateX(-12px) rotateZ(-5deg) scale(.5);
            }
            #isler.hover {
                -webkit-transform: translateX(-12px) rotateZ(-4deg) scale(.5);
                -moz-transform: translateX(-12px) rotateZ(-4deg) scale(.5);
                transform: translateX(-12px) rotateZ(-4deg) scale(.5);
            }
            #isler.acik {
                -webkit-transform: scale(.5) !important;
                -moz-transform: scale(.5) !important;
                transform: scale(.5) !important;
            }
            #isler.acik > .kat.click {
                font-size: 22px !important;
                line-height: 32px !important;
            }
            #projeListe {
                width: 80%;
            }
            #projeListe > li {
                width: 100%;
                margin: 10px 0;
            }
            #projeListe > li > .img {
                width: 92%;
                margin: 4% auto;
                max-width: 90%;
            }
            #iletisim > div, #iletisim > ul {
                width: 240px;
                margin-right: 15px;
                margin-left: 15px;
            }
            #iletisim > div:nth-child(3) {
                margin-top: 30px;
            }
            #iletisim > .sosyal {
                width: 330px;
                margin-top: 30px;
            }
            #iletisim > div > div {
                max-width: 174px !important;
            }
            .adres > div, .eposta > div {
                margin-left: 10px !important;
            }
        }
        @media screen and (max-width: 570px) {
            #ust > .logo {
                top: 60px;
                left: 5%;
            }
            #menu {
                width: 90%;
                height: auto;
                overflow: hidden;
                min-width: 320px;
                left: 5%;
                right: 5%;
            }
            #menu div {
                margin-bottom: 50px;
                width: 40px;
            }
            #menu li {
                float: left;
                margin: 0 10px 4px 10px;
            }
            #menu.kapali, #menu.zorlaKapali {
                left: 91%;
                height: 36px;
            }
            #menu.zorlaAcik {
                height: auto;
                left: 5%;
                right: 5%;
            }
            #intro > header {
                padding: 4%;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,.25);
                text-align: center
            }
            #sahne {
                left: 40%;
                -webkit-transform: scale(.5) translateY(220px);
                -moz-transform: scale(.5) translateY(220px);
                transform: scale(.5) translateY(220px);
            }
            #ortalama {
                height: 340px;
            }
            #Sahteisler {
                margin-top: -130px;
                margin-bottom: -130px;
            }
            #isler {
                -webkit-transform: translateX(-12px) rotateZ(-5deg) scale(.4);
                -moz-transform: translateX(-12px) rotateZ(-5deg) scale(.4);
                transform: translateX(-12px) rotateZ(-5deg) scale(.4);
            }
            #isler.hover {
                -webkit-transform: translateX(-12px) rotateZ(-4deg) scale(.4);
                -moz-transform: translateX(-12px) rotateZ(-4deg) scale(.4);
                transform: translateX(-12px) rotateZ(-4deg) scale(.4);
            }
            #isler.acik {
                -webkit-transform: scale(.4) !important;
                -moz-transform: scale(.4) !important;
                transform: scale(.4) !important;
            }
            #isler.acik > .kat {
                width: 300px;
            }
            #isler.acik > .kat.click {
                position: relative;
                font-size: 26px !important;
                line-height: 36px !important;
                width: 450px;
                z-index: 12;
            }
            #isler.acik > .kat.click >img {
                width: 450px;
            }
            #iletisim {
                padding-left: 0;
                padding-right: 0;
            }
            #iletisim > div, #iletisim > ul {
                width: 90%;
                margin: auto !important;
                display: block;
                margin-top: 10px !important;
            }
            #iletisim > .sosyal {
                width: 90%;
            }
            .sosyal > li {
                margin: 8px 2%;
            }
        }
        @media screen and (max-width: 450px) {
            #ortalama {
                height: 680px;
            }
            #Sahteisler {
                margin-top: 130px;
                transform-style: preserve-3d;
            }
            #isler {
                height: auto;
                margin-top: 0;
                overflow: hidden;
                perspective-origin: 50% 50%;
                -webkit-transform: scale(.5) translateY(-1000px) rotateZ(-4deg);
                -moz-transform: scale(.5) translateY(-1000px) rotateZ(-4deg);
                transform: scale(.5) translateY(-1000px) rotateZ(-4deg);
                -webkit-transition-property: transform, margin;
                -moz-transition-property: transform, margin;
                transition-property: transform, margin;
            }
            #isler .kat {
                padding: 20px !important;
                float: none;
                margin: auto;
            }
            #isler .kat:nth-child(1) {
                -webkit-transform: rotateX(10deg) translateY(8px);
                -moz-transform: rotateX(10deg) translateY(8px);
                transform: rotateX(10deg) translateY(8px);
            }
            #isler .kat:nth-child(2) {
                -webkit-transform: rotateX(-10deg);
                -moz-transform: rotateX(-10deg);
                transform: rotateX(-10deg);
            }
            #isler .kat:nth-last-child(1) {
                -webkit-transform: rotateX(5deg) translateY(-8px) translateZ(-18px);
                -moz-transform: rotateX(5deg) translateY(-8px) translateZ(-18px);
                transform: rotateX(5deg) translateY(-8px) translateZ(-18px);
                margin-bottom: 60px;
            }

            #isler.hover {
                -webkit-transform: scale(.5) translateY(-1000px) rotateZ(-3deg);
                -moz-transform: scale(.5) translateY(-1000px) rotateZ(-3deg);
                transform: scale(.5) translateY(-1000px) rotateZ(-3deg);
            }

            #isler.hover .kat:nth-child(1) {
                -webkit-transform: rotateX(8deg) translateY(6px);
                -moz-transform: rotateX(8deg) translateY(6px);
                transform: rotateX(8deg) translateY(6px);
            }
            #isler.hover .kat:nth-child(2) {
                -webkit-transform: rotateX(-8deg);
                -moz-transform: rotateX(-8deg);
                transform: rotateX(-8deg);
            }
            #isler.hover .kat:nth-last-child(1) {
                -webkit-transform: rotateX(4deg) translateY(-6px) translateZ(-15px);
                -moz-transform: rotateX(4deg) translateY(-6px) translateZ(-15px);
                transform: rotateX(4deg) translateY(-6px) translateZ(-15px);
                margin-bottom: 60px;
            }

            #isler.acik {
                -webkit-transform: scale(.6) translateY(-1000px) !important;
                -moz-transform: scale(.6) translateY(-1000px) !important;
                transform: scale(.6) translateY(-1000px) !important;
                margin-top: 330px;
            }
            #isler.acik > .kat {
                width: 350px;
            }
            #isler.acik > .kat.click {
                font-size: 20px !important;
                line-height: 28px !important;
                width: 400px;
                z-index: 12;
            }
            .sosyal > li {
                margin: 8px 1.3%;
            }
        }
        @media screen and (max-width: 400px) {
            #menu div {
                display: block;
                float: none;
                margin-bottom:0;
            }
            #menu li {
                display: block;
                float: none;
            }
            #iletisim > .sosyal {
                width: 100%;
            }
            .sosyal > li {
                margin: 8px 1px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            var w = $(window),
                d = $(document),
                int = $('#intro'),
                yu = $('.yuz.ust'),
                yso = $('.yuz.sol'),
                ysa = $('.yuz.sag'),
                yo = $('.yuz.on'),
                yal = $('.yuz.alt'),
                yar = $('.yuz.arka'),
                ev = $('#ev'),
                kt = $('.kat'),
                is = $('#isler'),
                mn = $('#menu'),
                ok = $('#ok'),
                about = $('#about'),
                projects = $('#projects'),
                contact = $('#contact'),
                intro = $('#home'),
                sT = 0,
                SA = 12;

            w.scroll(function(e) {
                sT = Math.clamp(w.scrollTop(), 0, w.height());
                if (w.width() < 570) {
                    if (sT < 40 && mn.hasClass('acik')) {
                        mn.css({
                            top: 60 - sT + 'px'
                        });
                        mn.removeClass('zorlaAcik');
                    }
                    if (sT > 39 && (mn.hasClass('acik') || mn.hasClass('zorlaAcik'))) {
                        mn.removeClass('acik');
                        mn.removeClass('zorlaAcik');
                        mn.addClass('kapali');
                        mn.removeAttr('style');
                        mn.removeClass('anim');
                    }
                } else {
                    if (sT < 40 && mn.hasClass('acik')) {
                        mn.css({
                            top: 60 - sT + 'px'
                        });
                        mn.removeClass('zorlaAcik');
                    } else if (mn.hasClass('kapali') || mn.hasClass('zorlaKapali')) {
                        mn.removeClass('kapali');
                        mn.removeClass('zorlaKapali');
                        mn.addClass('acik');
                        mn.css({
                            top: 60 - sT + 'px'
                        });
                        mn.removeClass('anim');
                    }
                    if (sT > 39 && mn.hasClass('acik')) {
                        mn.removeClass('acik');
                        mn.addClass('kapali');
                        mn.removeAttr('style');
                    }
                    mn.removeClass('anim');
                }
                /*	If you want to rotate the building	*/
                // ev.css({
                // 	transform: 'translateY('+-Sinus(sT,0,w.height()/3)*100+'px) rotateY('+-Sinus(sT,0,w.height()/2)*SA+'deg)'
                // 	//transform: 'rotateY('+-Sinus(sT,0,w.height()/2)*SA+'deg)'
                // });
                // int.css({
                // 	transform: 'translateY('+Sinus(sT,0,w.height()/3)*100+'px)'
                // });
                yso.css({
                    transform: 'translateX(-136px) rotateY(90deg) rotateX(' + (Sinus(sT, 0, w.height() / 3) * SA) + 'deg)',
                    animation: 'none'
                });
                ysa.css({
                    transform: 'translateX(136px) rotateY(90deg) rotateX(' + -(Sinus(sT, 0, w.height() / 3) * SA) + 'deg)',
                    animation: 'none'
                });
                $('.on>div').css({
                    transform: 'rotateY(' + ((90) - (Sinus(sT, 0, w.height() / 4) * SA * 6)) + 'deg)',
                    animation: 'none'
                });
                $('.sol>div').css({
                    transform: 'rotateY(' + ((-90) - (Sinus(sT, 0, w.height() / 4) * SA * 6)) + 'deg)',
                    animation: 'none'
                });
                $('.arka>div').css({
                    transform: 'rotateY(' + ((-90) - (Sinus(sT, 0, w.height() / 4) * SA * 6)) + 'deg)',
                    animation: 'none'
                });
                yo.css({
                    transform: 'translateZ(136px) rotateX(' + -(Sinus(sT, 0, w.height() / 3) * SA) + 'deg)',
                    animation: 'none'
                });
                yar.css({
                    transform: 'translateZ(-136px) rotateX(' + (Sinus(sT, 0, w.height() / 3) * SA) + 'deg)',
                    animation: 'none'
                });
                if (w.scrollTop() > $('#hakkinda').position().top + $('#hakkinda').height() || sT < w.height() / 3) {
                    if (is.hasClass('acik')) {
                        is.removeClass('acik');
                        kt.removeClass('click');
                    }
                }
            });

            $('*').not('#isler, .kat, .kat>.yazi, .kat>img, .kat>h2').click(function(event) {
                if (is.hasClass('acik')) {
                    event.stopImmediatePropagation();
                    is.removeClass('acik');
                    kt.removeClass('click');
                }
            });

            intro.click(function(event) {
                $("html, body").animate({
                    scrollTop: 0
                }, 1000);
            });
            ok.click(function(event) {
                $("html, body").animate({
                    scrollTop: w.height()
                }, 1000);
            });
            about.click(function(event) {
                $("html, body").animate({
                    scrollTop: w.height()
                }, 1000);
            });
            projects.click(function(event) {
                $("html, body").animate({
                    scrollTop: $('#projeler').offset().top
                }, 1000);
            });
            contact.click(function(event) {
                $("html, body").animate({
                    scrollTop: $('#iletisim').offset().top
                }, 1000);
            });
            $('#menu div').click(function() {
                if (mn.hasClass('zorlaKapali')) {
                    mn.removeClass('zorlaKapali');
                    mn.addClass('zorlaAcik');
                } else if (mn.hasClass('zorlaAcik')) {
                    mn.removeClass('zorlaAcik');
                    mn.addClass('zorlaKapali');
                } else if (sT < 60) {
                    if (mn.attr('class') == 'kapali') {
                        mn.addClass('zorlaAcik');
                    }
                    mn.addClass('zorlaKapali');
                } else if (sT > 59) {
                    mn.addClass('zorlaAcik');
                }
            });

            kt.mouseover(function() {
                if (!is.hasClass('acik')) is.addClass('hover');
            }).mouseout(function() {
                is.removeClass('hover');
            }).click(function(event) {
                event.stopImmediatePropagation();
                kt.removeClass('click');
                is.removeClass('hover');
                $(this).addClass('click');
                is.addClass('acik');
            });

            function Sinus(val, min, max) {
                return (val < max ? Math.sin(val * Math.PI / 2 / (max - min)) : Math.sin(max * Math.PI / 2 / (max - min)));
            }
        });

        $(window).load(function() {
            setTimeout(function() {
                $('body, html').removeClass('noTransition');
            }, 100);
        });

        (function() {
            Math.clamp = function(a, b, c) {
                return Math.max(b, Math.min(c, a));
            }
        })();
    </script>
@endsection