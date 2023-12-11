<?php

namespace App\Repository\doctor_dashboard;

use App\Models\Invoice;
use App\Models\Diagnostic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    // Get All insurance
    public function index()
    {

        // $invoices = Invoice::where(['doctor_id' =>  Auth::user()->id, 'invoice_date' =>  Carbon::now()->toDateString()])->get();
        ///////////////////////////////////////////////////////7
        // $invoices = Invoice::where('doctor_id', Auth::user()->id)
        // ->whereDate('invoice_date', '>=', Carbon::now()->toDateString())
        // ->get();

        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',1)->get();
        return view('Dashboard.Doctor.invoices.index', compact('invoices'));
    }

    public function completedInvoices()
    {

        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',3)->get();
        return view('Dashboard.doctor.invoices.completed_invoices', compact('invoices'));
    }

       public function reviewInvoices()
       {

        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',2)->get();
        return view('Dashboard.doctor.invoices.review_invoices', compact('invoices'));
          }

    public function create()
    {
        //
    }


    public function store($request)
    {

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update($request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->route('invoices.index');
    }

}
