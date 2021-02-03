@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش کاربر</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">ویرایش کاربر</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user"></i>
                        کاربران
                    </h3>
                </div>

                <div class="card-body pad">
                    @if ($errors->any())
                        <div class="alert alert-danger ">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                @if ($user->super_admin)
                        <div class="alert alert-danger">
                            ویرایش سوپر ادمین مجاز نیست . برای ویرایش اطلاعات سوپر ادمین از دیتابیس اقدام نمایید
                        </div>
                    @else
                    <form action="{{route('user.update',$user->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    نام
                                </label>
                                <input type="text" name="firstname" required value="{{$user->firstname}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>
                                   نام خانوادگی
                                </label>
                                <input type="text" name="lastname" required value="{{$user->lastname}}" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    تلفن همراه:
                                </label>
                                <input type="text" name="mobile" required value="{{$user->mobile}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>
                                وضعیت تلفن همراه کاربر
                                </label>
                                <select type="password" name="phone_verify" required class="form-control">
                                    <option  {{$user->phone_verify ? "":'selected'}} value="0">عدم تایید</option>
                                    <option {{$user->phone_verify ? "selected":''}} value="1">تایید شده</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label>
                                    کلمه عبور
                                </label>
                                <input type="password" name="password" onkeyup="f1()" id="password" placeholder="رمز عبور جدید " class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>
                                    تکرار کلمه عبور
                                </label>
                                <input type="password" name="re_password"  onkeyup="f1()" id="repassword" placeholder="تکرار کلمه عبور " class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="col-2">
                            <input type="submit" class="btn vb btn-success" value="ویرایش کاربر" id="submit">
                        </div>

                    </form>
                    @endif

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('script')
    <script>
        function f1() {
            pass = document.getElementById('password').value;
            repass = document.getElementById('repassword').value;
            if(pass != repass){
                document.getElementById('submit').disabled  = true;
            }else{
                document.getElementById('submit').disabled  = false;
            }
        }

    </script>

@endsection
