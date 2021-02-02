@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">تغییر دسترسی کاربر</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">تغییر دسترسی کاربر</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ثبت دسترسی</h3>
                </div>

                <form class="form-horizontal" action="{{ route('user.permission.store', $user->id) }}"
                      method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">مقام ها</label>
                            <select class="form-control" name="roles[]" id="roles" multiple>
                                @foreach(\MrjavadSeydi\AdminLTE\Models\Role::all() as $role)
                                    <option
                                        value="{{ $role->id }}" {{ in_array($role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $role->name }}
                                        - {{ $role->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">دسترسی ها</label>
                            <select class="form-control" name="permissions[]" id="permissions" multiple>
                                @foreach(\MrjavadSeydi\AdminLTE\Models\Permission::all() as $permission)
                                    <option
                                        value="{{ $permission->id }}" {{ in_array($permission->id , $user->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }}
                                        - {{ $permission->label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">ثبت مقام</button>
                        <a href="{{ route('user.index') }}" class="btn btn-default float-left">لغو</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('script')
    <script>
        $('#roles').select2({
            'placeholder': 'مقام مورد نظر را انتخاب کنید'
        })
        $('#permissions').select2({})
    </script>
@endsection
