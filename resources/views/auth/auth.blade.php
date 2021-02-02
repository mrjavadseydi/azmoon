<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v27.2.0/dist/font-face.css" rel="stylesheet"
          type="text/css"/>
    <title>ورود به حساب کاربری</title>
    @toastr_css
    <style>
        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

        *, :after, :before {
            box-sizing: border-box
        }

        .clearfix:after, .clearfix:before {
            content: '';
            display: table
        }

        .clearfix:after {
            clear: both;
            display: block
        }

        a {
            color: inherit;
            text-decoration: none
        }

        .login-wrap {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            background: url(https://raw.githubusercontent.com/khadkamhn/day-01-login-form/master/img/bg.jpg) no-repeat center;
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgba(40, 57, 101, .9);
        }

        .login-html .sign-in-htm,
        .login-html .sign-up-htm {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            transition: all .4s linear;
        }

        .login-html .sign-in,
        .login-html .sign-up,
        .login-form .group .check {
            display: none;
        }

        .login-html .tab,
        .login-form .group .label,
        .login-form .group .button {
            text-transform: uppercase;
        }

        .login-html .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }

        .login-html .sign-in:checked + .tab,
        .login-html .sign-up:checked + .tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-form {
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-form .group {
            margin-bottom: 15px;
        }

        .login-form .group .label,
        .login-form .group .input,
        .login-form .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-form .group .input,
        .login-form .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-form .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-form .group .button {
            background: #1161ee;
        }

        .login-form .group label .icon {
            width: 15px;
            height: 15px;
            border-radius: 2px;
            position: relative;
            display: inline-block;
            background: rgba(255, 255, 255, .1);
        }

        .login-form .group label .icon:before,
        .login-form .group label .icon:after {
            content: '';
            width: 10px;
            height: 2px;
            background: #fff;
            position: absolute;
            transition: all .2s ease-in-out 0s;
        }

        .login-form .group label .icon:before {
            left: 3px;
            width: 5px;
            bottom: 6px;
            transform: scale(0) rotate(0);
        }

        .login-form .group label .icon:after {
            top: 6px;
            right: 0;
            transform: scale(0) rotate(0);
        }

        .login-form .group .check:checked + label {
            color: #fff;
        }

        .login-form .group .check:checked + label .icon {
            background: #1161ee;
        }

        .login-form .group .check:checked + label .icon:before {
            transform: scale(1) rotate(45deg);
        }

        .login-form .group .check:checked + label .icon:after {
            transform: scale(1) rotate(-45deg);
        }

        .login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm {
            transform: rotate(0);
        }

        .login-html .sign-up:checked + .tab + .login-form .sign-up-htm {
            transform: rotate(0);
        }

        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot-lnk {
            text-align: center;
        }

        * {
            direction: rtl;
            font-family: Vazir !important;
        }
    </style>

</head>
<body dir="rtl">
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"
                                                                                 style="font-family: Vazir">ورود</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"
                                                                         style="font-family: Vazir">ثبت نام</label>
        <div class="login-form">
            <div class="sign-in-htm">
                <form method="post" action="{{route('auth')}}">
                    @csrf
                    <div class="group">
                        <label for="user" class="label">شماره موبایل</label>
                        <input id="user" type="text" name="mobile" class="input">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">رمز عبور</label>
                        <input id="pass" type="password" name="password" class="input" data-type="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="ورود">
                    </div>
                    <div class="hr"></div>
                    <div class="foot-lnk">
                        <a href="#forgot " style="font-family: 'Vazir'">رمز عبور خود را فراموش کرده اید؟</a>
                    </div>
                </form>
            </div>
            <div class="sign-up-htm">
                <form method="post" action="{{route('signup')}}">
                    @csrf
                    <div class="group">
                        <label for="user" class="label">نام </label>
                        <input id="user" type="text" name="firstname" class="input" value="{{old('firstname')}}">
                    </div>
                    <div class="group">
                        <label for="user" class="label"> نام خانوادگی</label>
                        <input id="user" type="text" name="lastname" class="input" value="{{old('lastname')}}">
                    </div>
                    <div class="group">
                        <label for="user" class="label">شماره موبایل</label>
                        <input id="user" type="text" name="mobile" class="input" value="{{old('mobile')}}">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">رمز عبور</label>
                        <input id="pass" type="password" class="input" name="password" data-type="password">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">تکرار رمز عبور</label>
                        <input id="pass" type="password" class="input" name="repassword" data-type="password">
                    </div>
                    <div class="group">
                        <input type="submit" class="button" value="ثبت نام">
                    </div>
                </form>

                <div class="hr"></div>
                <div class="foot-lnk">
                    <label for="tab-1" style="font-family: 'Vazir'">قبلا ثبت نام کرده اید؟</a>
                </div>
            </div>
        </div>
    </div>
</div>
@jquery
@toastr_js
@toastr_render
@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
        toastr.error('{{$error}}', '', []);
        @endforeach
    </script>
@endif
</body>
</html>
