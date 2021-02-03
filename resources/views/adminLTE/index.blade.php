@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">داشبورد</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">داشبورد</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')

        <h5 class="">فعالیت های قابل ثبت نام </h5>
        <div class="row">
            @foreach(\App\Models\Activity::whereNotIn('id',\App\Models\UserActivity::where('user_id',Auth::id())->pluck('activity_id'))->where([['start_date','<',\Carbon\Carbon::now()],['end_date','>',\Carbon\Carbon::now()]])->get() as $activity)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info-gradient">
                        <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
                        <a href="{{route('activity.show',$activity->id)}}" style="color: white">
                        <div class="info-box-content">
                            <span class="info-box-text">{{$activity->title}}</span>

                            <span class="progress-description">

                            جهت ثبت نام روی این لینک کلیک کنید


                        </span>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <h5 class="">فعالیت های ثبت نام شده</h5>
        <div class="row">
            @foreach(\App\Models\Activity::whereIn('id',\App\Models\UserActivity::where('user_id',Auth::id())->pluck('activity_id'))->get() as $activity)
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success-gradient">
                        <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{$activity->title}}</span>

                            <span class="progress-description">
                        <a href="{{route('activity.show',$activity->id)}}" style="color:white">
                            جهت دریافت اطلاعیه کلیک کنید
                        </a>


                        </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

@endsection
