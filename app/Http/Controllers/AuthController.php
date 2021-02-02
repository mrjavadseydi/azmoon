<?php

namespace App\Http\Controllers;

use App\Events\SmsEvent;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\SmsNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        if(!$user = User::whereMobile($request->mobile)->first()){
            toastr()->error('مقادیر ورودی را بررسی کنید ');
            return back();
        }
        if(!Hash::check($request->password,$user->password)){
            toastr()->error('مقادیر ورودی را بررسی کنید ');
            return back();
        }
        \Auth::loginUsingId($user->id);
        return redirect(route('auth'));
    }
    public function active(Request $request){
        if (!$request->has('code')) {
            toastr()->error('لطفا کد را وارد کنید');
            return back();
        }
        if (!session()->has('signup')||session('signup')['expire_at']<Carbon::now()) {
            toastr()->warning('دسترسی غیرمجاز');
            return redirect(route('auth'));
        }
        if ($request->code==session('signup')['code']) {
            $user = User::create([
                'firstname'=>session('signup')['firstname'],
                'lastname'=>session('signup')['lastname'],
                'mobile'=>session('signup')['mobile'],
                'password'=>session('signup')['password'],
                'phone_verify'=>1,
                'phone_verify_at'=>Carbon::now()
            ]);
            \Auth::loginUsingId($user->id);
            toastr('ثبت نام موفقیت آمیز بود');
            return redirect(route('auth'));
        }
    }
    public function signup(SignupRequest $request){
        $cod =mt_rand(1000,9999);
        session(['signup'=>[
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'mobile'=>$request->mobile,
            'password'=>\Hash::make($request->password),
            'expire_at'=>Carbon::now()->addMinutes(5),
            'code'=>$cod
        ]]);
        Notification::create([
            'code' => $cod,
            'mobile' => $request->mobile
        ]);
        return view('auth.phone');

    }
    public function signupget(){
        if (session()->has('signup')&session('signup')['expire_at']>Carbon::now()) {
            return view('auth.phone');
        }else{
            toastr()->warning('دسترسی غیرمجاز');
            return redirect(route('auth'));
        }
    }
    public function form(){
        return view('auth.auth');
    }
    public function logout(){
        \Auth::logout();
        return redirect(url('/'));
    }
}
