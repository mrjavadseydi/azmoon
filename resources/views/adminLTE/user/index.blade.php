@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">کاربران</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">کاربران</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-filter"></i>
                        فیلتر
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <form method="get">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی:</label>
                                    <input type="text" class="form-control" placeholder="نام و نام خانوادگی " name="name">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>ایمیل:</label>
                                    <input type="text" class="form-control" placeholder="ایمیل" name="email">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>تلفن همراه:</label>
                                    <input type="text" class="form-control" placeholder="تلفن همراه" name="mobile">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-success" value="فیلتر کن">
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            {{--!filter--}}

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-user"></i>
                        کاربران
                    </h3>
                </div>

                <div class="card-body pad table-responsive">
                    <table class="table table-striped" id="table-data2">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>نام کاربر</th>
                            <th>ایمیل</th>
                            <th>موبایل</th>
                            <th>وضعیت موبایل</th>
                            <th>تاریخ عضویت</th>
                            <th >عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $l =>$val)
                            <tr>
                                <td>{{$l+1}}.</td>
                                <td>
                                    @if($val->super_admin)
                                        <span class="badge badge-primary">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @endif
                                    {{$val->firstname." ".$val->lastname}}</td>
                                <td>
                                    {{$val->email}}
                                </td>
                                <td>
                                    {{$val->mobile}}
                                </td>
                                <td>
                                    @if ($val->phone_verify)
                                        <span class="badge badge-success"> تایید شده</span>
                                    @else
                                        <span class="badge badge-danger">عدم تایید </span>
                                    @endif
                                </td>
                                <td>
                                    {{$val->created_at}}
                                </td>
                                <td>
                                    @if (!$val->super_admin)
                                        <a href="{{route('user.edit',$val->id)}}" class="btn btn-sm btn-warning">
                                            <i  class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('user.permission',$val->id)}}" class="btn btn-sm btn-info" >
                                            <i class="fa fa-universal-access" ></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-danger trashbtn" data-id="{{$val->id}}">
                                            <i class="fa fa-trash" ></i>
                                        </a>

                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('script')

    <script type="text/javascript" src="{{asset('AdminAsset/plugin/datatables.js')}}"></script>
    <script>
        $(document).ready(function () {
            var table = $("#table-data2")
                .DataTable({
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that
                                        .search(this.value)
                                        .draw();
                                }
                            });
                        });
                    },
                    fixedHeader: true,
                    language: {
                        "info": " _START_ تا _END_ از _TOTAL_ ",
                        paginate: {
                            next: 'بعدی', // or '→'
                            previous: 'قبلی' // or '←'
                        },
                        "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
                        "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                        "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
                        "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ",",
                        "sLengthMenu": "نمایش _MENU_ رکورد",
                        "sLoadingRecords": "در حال بارگزاری...",
                        "sProcessing": "در حال پردازش...",
                        "sSearch": "جستجو:",
                        "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
                        "oPaginate": {
                            "sFirst": "ابتدا",
                            "sLast": "انتها",
                            "sNext": "بعدی",
                            "sPrevious": "قبلی"
                        }, "oExport": {
                            "sPrint": "ابتدا",
                        },
                        "oAria": {
                            "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                            "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
                        }
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: '<span> خروجی excel</span>',
                        },
                        {
                            extend: 'print',
                            text: '<span> چاپ</span>',
                            customize: function (win) {
                                $(win.document.body)
                                    .css('direction', 'rtl')
                                    .prepend(
                                        ''
                                    );

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]

                });

        });

    </script>
    <script src="{{asset('AdminAsset/plugin/sweetalert.js')}}"></script>
    <script>
        $(document).on('click', '.trashbtn', function (e) {
            let _token = $('div[name="destroy"]').attr('content');
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'آیا  اطمینان دارید ؟',
                text: "آیا از حذف این رکورد اطمینان دارید ؟ این دیتا قابل بازیابی نخواهد بود !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "خیر منصرف شدم!",
                confirmButtonText: 'بله !'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('admin/user')}}/"+id,
                        data: {id: id, _token: _token,_method:'DELETE'},
                        success: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'حذف رکورد از دیتابیس با موفقیت انجام شد !',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            setTimeout(function () {
                                window.location.reload();
                            }, 1800);

                        }
                    });
                }
            })
        });
    </script>

@endsection
