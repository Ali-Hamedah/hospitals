<?php

namespace App\Interfaces\Dashboard_RayEmployee;

interface InvoicesRepositoryInterface
{
    // Get Invoices Doctor
    public function index();

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);

    public function completed_invoices();

    public function show($id);


}
