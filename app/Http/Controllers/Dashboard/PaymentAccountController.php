<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use App\Http\Controllers\Controller;
use App\Interfaces\Finance\PaymentRepositoryInterface;

class PaymentAccountController extends Controller
{

    private $Payment;

    public function __construct(PaymentRepositoryInterface $Payment)
    {
        $this->Payment = $Payment;
    }

    public function index()
    {
       return $this->Payment->index();
    }


    public function create()
    {
        return $this->Payment->create();
    }


    public function store(Request $request)
    {
        return $this->Payment->store($request);
    }


    public function edit($id)
    {
        return $this->Payment->edit($id);
    }

    public function show($id)
    {
        return $this->Payment->show($id);
    }


    public function update(Request $request, $id)
    {
        return $this->Payment->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->Payment->destroy($request);
    }


    public function getRemainingAmount($patientId)
    {
        return $this->Payment->getRemainingAmount($patientId);
    }


}
