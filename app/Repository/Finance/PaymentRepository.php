<?php

namespace App\Repository\Finance;

use App\Models\Patient;
use App\Models\FundAccount;


use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Finance\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    function index()
    {
        $payments = PaymentAccount::all();
        return view('Dashboard.Payment.index', compact('payments'));
    }
    function create()
    {
        $Patients = Patient::all();
        return view('Dashboard.Payment.create', compact('Patients'));
    }

    public function show($id)
    {
        $payment_account = PaymentAccount::findorfail($id);
        return view('Dashboard.Payment.print',compact('payment_account'));
    }
    function store($request)
    {
        DB::beginTransaction();

        try {
            // store receipt_accounts
            $payment_accounts = new PaymentAccount();
            $payment_accounts->date = date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->credit;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->payment_id = $payment_accounts->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->payment_id = $payment_accounts->id;
            $patient_accounts->Debit = $request->credit;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Payment.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function edit($id)
    {
        $payment_accounts = PaymentAccount::findorfail($id);
        $Patients = Patient::all();
        return view('Dashboard.Payment.edit', compact('payment_accounts', 'Patients'));
    }

    function update($request)
    {
        DB::beginTransaction();

        try {

            // update receipt_accounts
            $payment_accounts = PaymentAccount::findorfail($request->id);
            $payment_accounts->date =date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->credit;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();

            // update fund_accounts
            $fund_accounts = FundAccount::where('Payment_id',$payment_accounts->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->Payment_id = $payment_accounts->id;
            $fund_accounts->credit = $request->credit;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->save();

            // update patient_accounts
            $patient_accounts = PatientAccount::where('Payment_id',$payment_accounts->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->Payment_id = $payment_accounts->id;
            $patient_accounts->Debit = $request->credit;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Payment.index');

        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    function destroy($request)
    {
        PaymentAccount::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('Payment.index');
    }


    public function getRemainingAmount($patientId)
    {

         // احسب إجمالي credit
         $totalCredit = PatientAccount::where('patient_id', $patientId)->sum('credit');

         // احسب إجمالي debit
         $totalDebit = PatientAccount::where('patient_id', $patientId)->sum('debit');

         // احسب المتبقي
         $remainingAmount = $totalCredit - $totalDebit;

         return response()->json(['remainingAmount' => $remainingAmount]);
    }





}
