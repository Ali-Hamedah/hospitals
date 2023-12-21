@extends('Dashboard.layouts.master')
@section('title')
    الكشوفات
@stop
@section('css')


    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الكشوفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> المطلوب</th>
                                <th>اسم الدكتور</th>
                                <th>اسم دكتور المختبر</th>
                                <th> ملاحظة المختبر</th>
                                <th>  العمليات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($laboratories as $laboratorie)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $laboratorie->description }}</td>
                                    <td>{{ $laboratorie->doctor->name }}</td>
                                    <td>{{ $laboratorie->employee->name }}</td>
                                    <td>{{ $laboratorie->description_employee }}</td>
                                    <td>
                                        @if($laboratorie->employee_id !== null)
                                            <a class="btn btn-primary btn-sm" href="{{route('view_laboratories',$laboratorie->id)}}" role="button">عرض التحليل</a>
                                        @endif                                                   </td>



                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

        <!-- /row -->
    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
