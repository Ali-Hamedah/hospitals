<?php

namespace App\Interfaces\doctor_dashboard;

interface LaboratoriesRepositoryInterface
{
    // Get Invoices Doctor
    public function index();





    public function store($request);







    public function update($request, $id);

    public function destroy($id);


}
