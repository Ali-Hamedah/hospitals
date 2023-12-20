<?php

namespace App\Interfaces\Dashboard_Laboratorie_Employee;

interface InvoicesRepositoryInterface
{
    // Get Invoices Doctor
    public function index();

    public function edit($id);

    public function update($request, $id);

    public function completed_invoices();

    public function show($id);


}
