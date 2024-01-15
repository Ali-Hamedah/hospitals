@extends('Dashboard.layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">{{ __('main-sidebar.Welcome_back_again') }}</h2>
                            <p class="mg-b-0">{{ auth()->user()->name }}</p>
                          </div>
					</div>

				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row row-sm">
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ __('Doctors.Number_invoices') }} </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Invoice::where('doctor_id',auth()->user()->id)->count() }}</h4>

										</div>

									</div>
								</div>
							</div>
							<span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ __('Doctors.Number_invoices_under_procedure') }} </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
											<h4 class="tx-20 font-weight-bold mb-1 text-white">
                                                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Invoice::where('doctor_id',auth()->user()->id)->where('invoice_status',1)->count() }}</h4>
                                        </h4>

										</div>

									</div>
								</div>
							</div>
							<span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ __('Doctors.Number_completed_invoices') }} </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Invoice::where('doctor_id',auth()->user()->id)->where('invoice_status',3)->count() }}</h4>

										</div>

									</div>
								</div>
							</div>
							<span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
						</div>
					</div>
					<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
								<div class="">
									<h6 class="mb-3 tx-12 text-white">{{ __('Doctors.Number_reviews_invoices') }} </h6>
								</div>
								<div class="pb-0 mt-0">
									<div class="d-flex">
										<div class="">
                                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Invoice::where('doctor_id',auth()->user()->id)->where('invoice_status',2)->count() }}</h4>

										</div>

									</div>
								</div>
							</div>
							<span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
						</div>
					</div>
				</div>
				<!-- row closed -->



				<!-- row opened -->
				<div class="row row-sm row-deck">

					<div class="col-md-12 col-lg-12 col-xl-12">
						<div class="card card-table-two">
							<div class="d-flex justify-content-between">
								<h4 class="card-title mb-1">Your Most Recent Earnings</h4>
								<i class="mdi mdi-dots-horizontal text-gray"></i>
							</div>

							<div class="table-responsive country-table">
                                <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th> {{ __('invoices.Invoice_Date') }}</th>
                                            <th> {{ __('patients.name') }}</th>
                                            <th> {{ __('Doctors.name') }}</th>
                                            <th>{{ __('insurance.notes') }}</th>
                                            <th>{{ __('Doctors.Status') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\Invoice::Latest()->take(5)->where(['invoice_status'=> 1, 'doctor_id'=> auth()->user()->id])->get() as $invoice)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $invoice->created_at }}</td>
                                                <td style="color: red">{{ $invoice->patient->name }}</td>
                                                <td>{{ $invoice->doctor->name }}</td>
                                                <td style="color: red">{{ $invoice->description }}</td>

                                                <td>
                                                    <a href="{{ route('invoices.index') }}">
                                                    @if ($invoice->case == 0)
                                                        <span class="badge badge-danger"> {{ __('laboratorie_employee.Under_procedure') }}</span>
                                                    @else
                                                        <span class="badge badge-success">{{ __('laboratorie_employee.Complete') }}</span>
                                                    @endif
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
		</div>
		<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Moment js -->
<script src="{{URL::asset('Dashboard/plugins/raphael/raphael.min.js')}}"></script>
<!--Internal  Flot js-->
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/chart.flot.sampledata.js')}}"></script>
<!--Internal Apexchart js-->
<script src="{{URL::asset('Dashboard/js/apexcharts.js')}}"></script>
<!-- Internal Map -->
<script src="{{URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/modal-popup.js')}}"></script>
<!--Internal  index js -->
<script src="{{URL::asset('Dashboard/js/index.js')}}"></script>
<script src="{{URL::asset('Dashboard/js/jquery.vmap.sampledata.js')}}"></script>
@endsection
