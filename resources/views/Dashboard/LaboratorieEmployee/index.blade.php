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
                           اضافة موظف جديد
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>تاريخ الاضافة</th>

                                        <th> العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$employee->name}}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->created_at->diffForHumans() }}</td>
                                            <td>

                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-toggle="modal" href="#edit{{ $employee->id}}"><i
                                                             class="las la-pen"></i></a>
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal" href="#delete{{ $employee->id }}"><i
                                                        class="las la-trash"></i></a>
                                            </td>


                                        </tr>
                                        @include('Dashboard.LaboratorieEmployee.edit')
                                        @include('Dashboard.LaboratorieEmployee.delete')
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
    @include('Dashboard.LaboratorieEmployee.add')
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
