<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    // get Doctor
    public function index();

    // create Doctor
    public function create();

    public function store($request);

    public function edit($id);

    public function destroy($request);

    public function update($request);

      // update_password
      public function update_password($request);

          // update_status
    public function update_status($request);

}
