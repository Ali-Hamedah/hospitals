@extends('Dashboard.layouts.master')
@section('css')

@endsection

@section('content')
@include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row">



        <!-- row opened -->

        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                {{ __('laboratorie_employee.Add_New_Employee') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('laboratorie_employee.Name') }}</th>
                                        <th> {{ __('Doctors.email') }}</th>
                                        <th> {{ __('Doctors.created_at') }}</th>

                                        <th> {{ __('Doctors.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($RayEmployees as $RayEmployee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{route('Sections.show',$RayEmployee->id)}}">{{$RayEmployee->name}}</a> </td>
                                            <td>{{ $RayEmployee->email }}</td>
                                            <td>{{ $RayEmployee->created_at->diffForHumans() }}</td>
                                            <td>

                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-toggle="modal" href="#edit{{ $RayEmployee->id}}"><i
                                                             class="las la-pen"></i></a>
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal" href="#delete{{ $RayEmployee->id }}"><i
                                                        class="las la-trash"></i></a>
                                            </td>


                                        </tr>
                                        @include('Dashboard.RayEmployees.edit')
                                        @include('Dashboard.RayEmployees.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    @include('Dashboard.RayEmployees.add')
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
