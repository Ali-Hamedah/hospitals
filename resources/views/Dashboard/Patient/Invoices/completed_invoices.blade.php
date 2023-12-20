@extends('Dashboard.layouts.master')
@section('title')
    الكشوفات
@stop
@section('css')


    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ الفاتورة</th>
                                    <th>اسم المريض</th>
                                    <th>اسم الدكتور</th>
                                    <th>المطلوب</th>
                                    <th>حالة الفاتورة</th>
                                    <th>الاشعة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->created_at }}</td>
                                        <td>{{ $invoice->Patient->name }}</td>
                                        <td>{{ $invoice->doctor->name }}</td>
                                        <td>{{ $invoice->description }}</td>
                                        <td>
                                            @if ($invoice->case == 0)
                                                <span class="badge badge-danger">تحت الاجراء</span>
                                            @else
                                                <span class="badge badge-success">مكتملة</span>
                                            @endif
                                        </td>

                                        {{-- <td>
            @forelse($invoice->images as $image)
                <a href="#" onclick="openImageWindow('{{ asset('Dashboard/img/rays/' . $image->filename) }}')">
                    <img src="{{ asset('Dashboard/img/rays/' . $image->filename) }}" style="max-width: 100px; max-height: 100px;">
                </a>
            @empty
                <span>لا توجد صور</span>
            @endforelse
        </td> --}}
                                        <td>

                                            <a class="modal-effect btn btn-sm "
                                                href="{{ route('invoices_laboratorie_employee.show', $invoice->id) }}"><img
                                                    src="{{ asset('Dashboard/img/laboratories/' . $invoice->image->filename) }}"
                                                    style="max-width: 100px; max-height: 100px;"></a>
                                        </td>

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
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        function openImageWindow(imagePath) {
            window.open(imagePath, '_blank', 'width=800,height=600');
        }
    </script>


@endsection
