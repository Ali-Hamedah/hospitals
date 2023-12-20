@extends('Dashboard.layouts.master')
@section('title')
    الكشوفات
@stop
@section('css')

    <!-- Internal Data table css -->
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css') }}"
        rel="stylesheet">
    <link href="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.css') }}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الكشوفات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    الفواتير</span>
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
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                    data-toggle="tab">سجل المريض</a></li>
                                            <li class="nav-item"><a href="#tab2" class="nav-link"
                                                    data-toggle="tab">الاشعة</a>
                                            </li>
                                            <li class="nav-item"><a href="#tab3" class="nav-link"
                                                    data-toggle="tab">المختبر</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">

                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="vtimeline">
                                                @foreach ($patient_records as $patient_record)
                                                    <div
                                                        class="timeline-wrapper {{ auth()->user()->id == $patient_record->doctor_id ? '' : 'timeline-inverted' }} timeline-wrapper-primary">
                                                        <div class="timeline-badge"><i class="las la-check-circle"></i>
                                                        </div>
                                                        <div class="timeline-panel">
                                                            <div class="timeline-heading">
                                                                <h6 class="timeline-title">تحديث في حالة المريض</h6>
                                                            </div>
                                                            <div class="timeline-body">
                                                                <p>{{ $patient_record->diagnosis }}</p>
                                                            </div>
                                                            <div
                                                                class="timeline-footer d-flex align-items-center flex-wrap">
                                                                <i class="fas fa-user-md"></i>&nbsp;
                                                                <span
                                                                    style="color: rgb(61, 61, 212)">{{ $patient_record->Doctor->name }}</span>
                                                                <span class="mr-auto"><i
                                                                        class="fe fe-calendar text-muted mr-1"></i>{{ $patient_record->date }}</span>

                                                                <!-- زر الحذف -->

                                                                <div>
                                                                    @if ($patient_record->doctor_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            data-target="#Delete{{ $patient_record->id }}"
                                                                            data-toggle="modal" href="#">
                                                                            <i class="fa fa-trash"
                                                                                style="color: red"></i>&nbsp; حذف
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @include('Dashboard.doctor.invoices.delete_Diagnostics')
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- End Show Information Patient --}}

                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">

                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>اسم الخدمه</th>
                                                            <th> اسم الدكتور</th>
                                                            <th>اسم موظف الاشعة</th>
                                                            <th> حالة الكشف</th>
                                                            <th> العمليات </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($patient_rays as $patient_ray)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td> {{ $patient_ray->description }} </td>
                                                                <td>{{ $patient_ray->doctor->name }}</td>
                                                                <td> {{ $patient_ray->employee->name }} </td>
                                                                <td
                                                                    style="color: {{ $patient_ray->case == 1 ? 'green' : 'red' }}">
                                                                    {{ $patient_ray->case == 1 ? 'مكتمله' : 'غير مكتمله' }}
                                                                </td>

                                                                @if ($patient_ray->doctor_id == auth()->user()->id)
                                                                    @if ($patient_ray->case == 0)
                                                                        <td>
                                                                            <a class="modal-effect btn btn-sm btn-primary"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#edit_ray{{ $patient_ray->id }}"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                            <a class="modal-effect btn btn-sm btn-danger"
                                                                                data-effect="effect-scale"
                                                                                data-toggle="modal"
                                                                                href="#delete{{ $patient_ray->id }}"><i
                                                                                    class="las la-trash"></i></a>
                                                                        </td>
                                                                    @else
                                                                        <td>

                                                                            <a class="modal-effect btn btn-sm "
                                                                                href="{{ route('invoices.show', $patient_ray->id) }}"><img
                                                                                    src="{{ asset('Dashboard/img/rays/' . $patient_ray->image->filename) }}"
                                                                                    style="max-width: 100px; max-height: 100px;"></a>
                                                                        </td>
                                                                    @endif
                                                                @endif
                                            </div>
                                            </tr>
                                            @include('Dashboard.doctor.invoices.edit_ray')
                                            @include('Dashboard.doctor.invoices.delete_ray')
                                            @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- End Invices Patient --}}

                                    {{-- Start Receipt Patient  --}}

                                    <div class="tab-pane" id="tab3">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-md-nowrap text-center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>اسم الخدمه</th>
                                                        <th> اسم الدكتور</th>
                                                        <th> العمليات </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($patient_Laboratories as $patient_laboratorie)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td> {{ $patient_laboratorie->description }} </td>
                                                            <td>{{ $patient_laboratorie->doctor->name }}</td>

                                                            <td>
                                                                @if ($patient_laboratorie->case == 0)
                                                                    @if ($patient_laboratorie->doctor_id == auth()->user()->id)
                                                                        <a class="btn btn-primary btn-sm"
                                                                            data-target="#edit_laboratories{{ $patient_laboratorie->id }}"
                                                                            data-toggle="modal"
                                                                            href="#edit_laboratories{{ $patient_laboratorie->id }}"
                                                                            title="تعديل">
                                                                            <i class="fas fa-edit"></i>&nbsp;
                                                                            <span class="d-inline-block"> </span>
                                                                        </a>

                                                                        <a class="btn btn-danger btn-sm"
                                                                            data-target="#delete{{ $patient_laboratorie->id }}"
                                                                            data-toggle="modal"
                                                                            href="#delete{{ $patient_laboratorie->id }}"
                                                                            title="حذف">
                                                                            <i class="fa fa-trash"></i>&nbsp;
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <a class="modal-effect btn btn-sm "
                                                                        href="{{ route('laboratories.show', $patient_laboratorie->id) }}"><img
                                                                            src="{{ asset('Dashboard/img/laboratories/' . $patient_laboratorie->image->filename) }}"
                                                                            style="max-width: 100px; max-height: 100px;"></a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        @include('Dashboard.doctor.invoices.edit_laboratories')
                                                        @include('Dashboard.doctor.invoices.delete_laboratories')
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- End Receipt Patient  --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Prism Precode -->
                </div>
            </div>
        </div>
    </div>


    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')


    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('dashboard/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('dashboard/js/form-elements.js') }}"></script>

@endsection
