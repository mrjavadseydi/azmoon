@extends('adminLTE::master.master')
@section('position')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">مقام ها</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{route('adminPanel')}}">خانه</a></li>
                <li class="breadcrumb-item active">مقام ها</li>
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
                        <span class="text-right d-inline">
                            <i class="fa fa-universal-access"></i>
                       مقام ها
                            </span>
                        <span class="text-left d-inline">
                            <a href="{{route('roles.create')}}" class="btn btn-sm btn-outline-info" style="float: left">
                                ساخت مقام جدید
                            </a>
                        </span>

                    </h3>
                </div>

                <div class="card-body pad table-responsive">
                    <table class="table table-striped" id="table-data2">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>نام دسترسی</th>
                            <th>توضیح دسترسی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $l =>$val)
                            <tr>
                                <td>{{$l+1}}.</td>
                                <td>
                                    {{$val->name}}
                                </td>
                                <td>
                                    {{$val->label}}
                                </td>
                                <td>
                                    <a href="{{route('roles.edit',$val->id)}}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-sm btn-danger trashbtn" data-id="{{$val->id}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="tfhide" style="border-top:1px dashed black ">
                        <tr>
                            <th></th>
                            <th class="filter">
                                <input id="title" class="form-control" type="text" placeholder="نام دسترسی">
                            </th>
                            <th class="">
                                <input id="date" class="form-control" type="text" placeholder="توضیح دسترسی">
                            </th>
                            <th class="">
                            </th>
                        </tr>
                        </tfoot>

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
            $('.tfhide').hide();
            var table = $("#table-data2")
                .DataTable({

                    initComplete: function () {
                        // Apply the search
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
                    buttons: [{
                        text: '<span> فیلتر </span>',
                        action: function () {
                            $('.tfhide').toggle(1000);
                        }
                    },
                        {
                            extend: 'excel',
                            text: '<span> خروجی excel</span>',
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
                        url: "{{url('admin/roles')}}/" + id,
                        data: {id: id, _token: _token, _method: 'DELETE'},
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
