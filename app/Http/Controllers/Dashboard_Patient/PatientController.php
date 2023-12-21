<?php

namespace App\Http\Controllers\Dashboard_Patient;

use auth;
use App\Models\Ray;
use App\Models\Invoice;
use App\Models\Laboratorie;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Models\ReceiptAccount;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{

    public function invoices()
    {
        $invoices = Invoice::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Dashboard_Patient.invoices', compact('invoices'));
    }

    public function laboratories()
    {
        $laboratories = Laboratorie::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Dashboard_Patient.laboratories', compact('laboratories'));
    }

    public function viewLaboratories($id)
    {
        $laboratories = Laboratorie::findOrFail($id);
        if ($laboratories->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.Dashboard_Patient.view_laboratories', compact('laboratories'));
    }

    public function raysPatient()
    {
        $rays = Ray::where('patient_id', auth()->user()->id)->get();

        return view('Dashboard.Dashboard_Patient.rays', compact('rays'));
    }

    public function viewRays($id)
    {
        $rays = Ray::findOrFail($id);
        if ($rays->patient_id != auth()->user()->id) {
            return redirect()->route('404');
        }
        return view('Dashboard.Dashboard_Patient.view_rays', compact('rays'));
    }

    public function Payments()
    {

        $payments = ReceiptAccount::where('patient_id', auth()->user()->id)->get();
        return view('Dashboard.Dashboard_Patient.payments', compact('payments'));
    }
}
