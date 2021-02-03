@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">ویرایش مقام</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">ویرایش مقام</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">فرم ویرایش مقام</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ route('roles.update' , $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail3" class="col-sm-2 control-label">عنوان مقام</label>
                                <input type="text" name="name" class="form-control" id="inputEmail3"
                                       placeholder="عنوان مقام را وارد کنید" value="{{ old('name' , $role->name) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail3" class="col-sm-2 control-label">توضیح مقام</label>
                                <input type="text" name="label" class="form-control" id="inputEmail3"
                                       placeholder="توضیح مقام را وارد کنید" value="{{ old('label' , $role->label) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">دسترسی ها</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach(\MrjavadSeydi\AdminLTE\Models\Permission::all() as $permission)
                                    <option
                                        value="{{ $permission->id }}" {{ in_array($permission->id , $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }}
                                        - {{ $permission->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ویرایش مقام</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $('#permissions').select2({
            'placeholder' : 'دسترسی مورد نظر را انتخاب کنید'
        })
    </script>
@endsection
