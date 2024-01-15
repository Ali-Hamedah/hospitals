@extends('Dashboard.layouts.master')
@section('title')
    الاشعة
@stop
@section('css')


    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('main-sidebar.X-ray') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('main-sidebar.Invoices') }}</span>
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
                                <th> {{ __('insurance.notes') }}</th>
                                <th> {{ __('Doctors.name') }}</th>
                                <th>{{ __('ray_employee.x-ray_Doctor_Name') }}</th>
                                <th> {{ __('ray_employee.x-ray_Note') }}</th>
                                <th>  {{ __('Doctors.Processes') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rays as $ray)
                                <tr>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $ray->description }}</td>
                                    <td>{{ $ray->doctor->name }}</td>
                                    <td>{{ $ray->employee->name }}</td>
                                    <td>{{ $ray->description_employee }}</td>
                                    <td>
                                        @if($ray->employee_id !== null)
                                            <a class="btn btn-primary btn-sm" href="{{route('view_rays',$ray->id)}}" role="button">عرض التحليل</a>
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
