<?php

namespace App\Http\Controllers\Dashboard_RayEmployee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_RayEmployee\InvoicesRepositoryInterface;

class InvoiceController extends Controller
{
    protected $invoicesRepository;
    public function __construct(InvoicesRepositoryInterface $invoicesRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
    }

    public function index()
    {
        return $this->invoicesRepository->index();
    }

    public function edit($id)
    {
        return $this->invoicesRepository->edit($id);
    }


    public function update(Request $request, $id)
    {

         return $this->invoicesRepository->update($request, $id);
    }


    public function destroy($id)
    {
        //
    }

    public function completed_invoices()
    {
        return $this->invoicesRepository->completed_invoices();
    }

    public function show($id)
    {
        return $this->invoicesRepository->show($id);
    }
}
