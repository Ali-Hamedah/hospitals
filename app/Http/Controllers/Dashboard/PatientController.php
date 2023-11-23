<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientController extends Controller
{

    private $Patients;

    public function __construct(PatientRepositoryInterface $Patients)
    {
        $this->Patients = $Patients;
    }

    public function index()
    {
        return $this->Patients->index();
    }



    public function create()
    {
        return $this->Patients->create();
    }

    public function store(StorePatientRequest $request)
    {
        return $this->Patients->store($request);
    }


    public function edit($id)
    {
        return $this->Patients->edit($id);    }

    public function update(StorePatientRequest $request)
    {
        return $this->Patients->update($request);    }


    public function destroy(Request $request)
    {
        return $this->Patients->destroy($request);
     }
}
