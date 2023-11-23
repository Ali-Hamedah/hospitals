@extends('Dashboard.layouts.master')
@section('title')
    {{ trans('main-sidebar_trans.Single_service') }}
@stop
@section('css')

    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar_trans.Services') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main-sidebar_trans.Single_service') }}</span>
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
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('ambulance.create') }}" class="btn btn-primary">اضافة سيارة جديدة</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('ambulances.car_number') }}</th>
                                    <th> {{ trans('ambulances.car_model') }}</th>
                                    <th> {{ trans('ambulances.car_year_made') }}</th>
                                    <th> {{ trans('ambulances.car_type') }}</th>
                                    <th>{{ trans('ambulances.driver_name') }}</th>
                                    <th>{{ trans('ambulances.driver_license_number') }}</th>
                                    <th> {{ trans('ambulances.driver_phone') }}</th>
                                    <th>{{ trans('ambulances.is_available') }}</th>
                                    <th>{{ trans('ambulances.description') }}</th>
                                    <th>{{ trans('ambulances.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ambulances as $ambulance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ambulance->car_number }}</td>
                                        <td>{{ $ambulance->car_model }}</td>
                                        <td>{{ $ambulance->car_year_made }}</td>
                                        <td>{{ $ambulance->car_type == 1 ? 'مملكوكة' : 'ايجار' }}</td>
                                        <td>{{ $ambulance->driver_name }}</td>
                                        <td>{{ $ambulance->driver_license_number }}</td>
                                        <td>{{ $ambulance->driver_phone }}</td>
                                        <td>
                                            <div
                                                class="dot-label bg-{{ $ambulance->is_available == 1 ? 'success' : 'danger' }} ml-1">
                                            </div>
                                            {{ $ambulance->is_available == 1 ? trans('doctors.Enabled') : trans('doctors.Not_enabled') }}
                                        </td>
                                        <td> {{ Str::limit($ambulance->notes, 50) }}</td>

                                        <td>
                                            <a href="{{ route('ambulance.edit', $ambulance->id) }}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $ambulance->id }}"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Ambulances.Deleted')
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
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
