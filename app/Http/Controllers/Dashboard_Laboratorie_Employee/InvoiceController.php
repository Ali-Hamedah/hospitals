<?php

namespace App\Http\Controllers\Dashboard_Laboratorie_Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard_Laboratorie_Employee\InvoicesRepositoryInterface;


class InvoiceController extends Controller
{
    private $Laboratorie_Employee;

    public function __construct(InvoicesRepositoryInterface $Laboratorie_Employee)
    {
        $this->Laboratorie_Employee = $Laboratorie_Employee;
    }
    public function index()
    {
      return  $this->Laboratorie_Employee->index();

    }


    public function create()
    {
        return  $this->Laboratorie_Employee->index();    }


    public function show($id)
    {
        return  $this->Laboratorie_Employee->show($id);
    }


    public function edit($id)
    {
        return  $this->Laboratorie_Employee->edit($id);
    }


    public function update(Request $request, $id)
    {
        return  $this->Laboratorie_Employee->update($request, $id);
    }

    public function completed_invoices()
    {
     return $this->Laboratorie_Employee->completed_invoices();
    }
}
