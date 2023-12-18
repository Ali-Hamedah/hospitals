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
                                {{trans('sections_trans.add_sections')}}
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap" id="example2">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">#</th>
                                        <th class="wd-15p border-bottom-0">
                                            {{ trans('sections_trans.name_sections') }}</th>
                                        <th class="wd-20p border-bottom-0">
                                            {{ trans('sections_trans.created_at') }}</th>
                                        <th class="wd-20p border-bottom-0">{{ trans('sections_trans.Processes') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{route('Sections.show',$section->id)}}">{{$section->name}}</a> </td>
                                            <td>{{ $section->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                    data-toggle="modal" href="#edit{{ $section->id }}"><i
                                                        class="las la-pen"></i></a>
                                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                    data-toggle="modal" href="#delete{{ $section->id }}"><i
                                                        class="las la-trash"></i></a>
                                            </td>
                                        </tr>
                                        @include('Dashboard.Sections.edit')
                                        @include('Dashboard.Sections.delete')
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
    @include('Dashboard.Sections.add')
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
