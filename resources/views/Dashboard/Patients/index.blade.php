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
                <h4 class="content-title mb-0 my-auto">{{ trans('main-sidebar.Services') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main-sidebar.Single_service') }}</span>
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
                        <a href="{{ route('Patients.create') }}" class="btn btn-primary">   {{ trans('patients.Add_new_patient') }}</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> {{ trans('patients.name') }}</th>
                                    <th> {{ trans('patients.email') }}</th>
                                    <th> {{ trans('patients.Date_Birth') }}</th>
                                    <th> {{ trans('patients.Phone') }}</th>
                                    <th>{{ trans('patients.Gender') }}</th>
                                    <th>{{ trans('patients.Blood_Group') }}</th>
                                    <th> {{ trans('patients.Address') }}</th>
                                    <th>{{ trans('ambulances.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $patient->name }}</td> --}}
                                        <td><a href="{{ route('Patients.show', $patient->id) }}">{{ $patient->name }}</a></td>
                                        <td>{{ $patient->email }}</td>
                                        <td>{{ $patient->Date_Birth }}</td>
                                        <td>{{ $patient->Phone }}</td>
                                        <td>{{$patient->Gender == 1 ?  trans('patients.male')  : trans('patients.Female')  }}</td>
                                        <td>{{ $patient->Blood_Group }}</td>
                                        <td> {{ Str::limit($patient->Address, 50) }}</td>
                                        <td>
                                            <a href="{{route('Patients.edit',$patient->id)}}"
                                                class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-sm btn-danger" data-toggle="modal"
                                                data-target="#Deleted{{ $patient->id }}"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
@include('Dashboard.Patients.Deleted')
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
