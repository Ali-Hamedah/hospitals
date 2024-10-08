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
                <h4 class="content-title mb-0 my-auto">{{ __('main-sidebar.Statements') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('main-sidebar.Invoices') }}</span>
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
                                    <th> {{ __('invoices.Invoice_Date') }}</th>
                                    <th> {{ __('Services.name') }}</th>
                                    <th> {{ __('patients.name') }}</th>
                                    <th> {{trans('Services.price')}}</th>
                                    <th> {{trans('invoices.Discount')}}</th>
                                    <th> {{trans('invoices.Tax_Rate')}}</th>
                                    <th> {{trans('invoices.Tax_Value')}}</th>
                                    <th>  {{trans('invoices.Total_with_tax')}}</th>
                                    <th>{{ __('Doctors.Status') }}</th>
                                    <th>  {{trans('invoices.Review_Date')}}</th>
                                    <th>{{ __('Doctors.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>
                                            @if (($invoice->Service && $invoice->Service->locale == 'ar') || ($invoice->Group && $invoice->Group->locale == 'ar'))
                                                {{ $invoice->Service->name ?? $invoice->Group->name }}
                                            @else
                                                يجب إضافة الترجمة
                                            @endif
                                        </td>
                                        <td><a href="{{route('patient_details',$invoice->patient_id)}}">{{ $invoice->Patient->name }}</a></td>
                                        <td>{{ number_format($invoice->price, 2) }}</td>
                                        <td>{{ number_format($invoice->discount_value, 2) }}</td>
                                        <td>{{ $invoice->tax_rate }}%</td>
                                        <td>{{ number_format($invoice->tax_value, 2) }}</td>
                                        <td>{{ number_format($invoice->total_with_tax, 2) }}</td>
                                        <td>
                                            @if($invoice->invoice_status == 1)
                                            <span class="badge badge-danger"> {{ __('laboratorie_employee.Under_procedure') }}</span>
                                       @elseif($invoice->invoice_status == 2)
                                            <span class="badge badge-warning">{{ __('laboratorie_employee.Review') }}</span>
                                        @else
                                           <span class="badge badge-success">{{ __('laboratorie_employee.Complete') }}</span>
                                        @endif
                                        </td>
                                        <td style="color: goldenrod">
                                            @if (\App\Models\Diagnostic::where(['invoice_id' => $invoice->id])->first()->review_date)
                                                {{\Carbon\Carbon::parse(\App\Models\Diagnostic::where(['invoice_id' => $invoice->id])->first()->review_date)->format('y-m-d H:i')}}
                                            @else
                                                لا يوجد مراجعه
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-primary btn-sm dropdown-toggle" href="#"
                                                    role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> <i
                                                        class="fas fa-chevron-down"></i>
                                                    العمليات
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                        data-target="#add_diagnosis{{ $invoice->id }}" data-toggle="modal"
                                                        href="#add_ff{{ $invoice->id }}">
                                                        <i class="fas fa-stethoscope" style="color: #0000cc"></i>&nbsp;
                                                        <span class="d-inline-block">اضافة تشخيص </span>
                                                    </a>
                                                    <a class="dropdown-item" data-target="#add_review{{ $invoice->id }}"
                                                        data-toggle="modal" href="#">
                                                        <i class="fa fa-plus-circle" style="color: green"></i>&nbsp; اضافة
                                                        مراجعة
                                                    </a>
                                                    <a class="dropdown-item" data-target="#add_ray{{ $invoice->id }}"
                                                        data-toggle="modal" href="#">
                                                        <i class="fas fa-radiation" style="color: #0000cc"></i>&nbsp; تحويل
                                                        الى الاشعة
                                                    </a>
                                                    <a class="dropdown-item"
                                                        data-target="#add_laboratorie{{ $invoice->id }}"
                                                        data-toggle="modal" href="#">
                                                        <i class="fas fa-microscope" style="color: #007BFF"></i>&nbsp; تحويل
                                                        الى المختبر
                                                    </a>
                                                    <a class="dropdown-item" data-target="#Delete{{ $invoice->id }}"
                                                        data-toggle="modal" href="#delete{{ $invoice->id }}">
                                                        <i class="fa fa-trash" style="color: red"></i>&nbsp; حذف البيانات
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('Dashboard.doctor.invoices.add_diagnosis')
                                    @include('Dashboard.doctor.invoices.add_review')
                                    @include('Dashboard.doctor.invoices.add_ray')
                                    @include('Dashboard.doctor.invoices.add_laboratorie')
                                    @include('Dashboard.doctor.invoices.delete')
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
