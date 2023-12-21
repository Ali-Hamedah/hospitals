<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Models\Ray;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laboratorie;

class PatientDetailsController extends Controller
{
    public function index($id){

        $patient_records = Diagnostic::where('patient_id',$id)->get();
        $patient_rays = Ray::where('patient_id',$id)->get();
        $patient_Laboratories  = Laboratorie::where('patient_id',$id)->get();
        return view('Dashboard.doctor.invoices.patient_details',compact('patient_records','patient_rays','patient_Laboratories'));
    }
}
