<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
    // Get Invoices Doctor
    public function index();

    public function completedInvoices();

    public function create();


    public function store($request);

    public function reviewInvoices();

    public function show($id);


    public function edit($id);

    public function update($request, $id);

    public function destroy($id);


}
