<?php

namespace App\Repository\doctor_dashboard;

use App\Models\Invoice;
use App\Models\Diagnostic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;

class DiagnosisRepository implements DiagnosisRepositoryInterface
{
    // Get All insurance
    public function index()
    {
    }

    public function create()
    {
        //
    }


    public function store($request)
    {

        DB::beginTransaction();
        try {

            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            // تحديث بيانات الفاتورة
            $this->invoice_status($request->invoice_id, 3);

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function addReview($request)
    {

        DB::beginTransaction();
        try {

            $diagnosis = new Diagnostic();
            $diagnosis->date = date('Y-m-d');
            $diagnosis->review_date =  $request->review_date;
            $diagnosis->diagnosis = $request->diagnosis;
            $diagnosis->medicine = $request->medicine;
            $diagnosis->invoice_id = $request->invoice_id;
            $diagnosis->patient_id = $request->patient_id;
            $diagnosis->doctor_id = $request->doctor_id;
            $diagnosis->save();

            // تحديث بيانات الفاتورة
            $this->invoice_status($request->invoice_id, 2);

            DB::commit();
            session()->flash('add');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $patient_records = Diagnostic::all();
        return view('Dashboard.doctor.invoices.patient_record', compact('patient_records'));
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
        Diagnostic::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }

    public function invoice_status($invoice_id, $id_status)
    {
        $invoice_status = Invoice::findorFail($invoice_id);
        $invoice_status->update([
            'invoice_status' => $id_status
        ]);
    }
}
