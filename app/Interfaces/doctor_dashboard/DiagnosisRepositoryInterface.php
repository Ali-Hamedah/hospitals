<?php

namespace App\Interfaces\doctor_dashboard;

interface DiagnosisRepositoryInterface
{
    // Get Invoices Doctor
    public function index();

    public function create();


    public function store($request);

    public function addReview($request);

    public function show($id);


    public function edit($id);

    public function update($request, $id);

    public function destroy($id);


}
