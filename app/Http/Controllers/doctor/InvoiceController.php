<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;

class InvoiceController extends Controller
{

    protected $invoicesRepository;

    public function __construct(InvoicesRepositoryInterface $invoicesRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
    }

    public function index()
    {
        return  $this->invoicesRepository->index();
    }

    public function completedInvoices()
    {
        return  $this->invoicesRepository->completedInvoices();
       }

          public function reviewInvoices()
          {
              return  $this->invoicesRepository->reviewInvoices();
             }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return  $this->invoicesRepository->store($$request);
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        return $this->invoicesRepository->destroy($id);
    }
}
