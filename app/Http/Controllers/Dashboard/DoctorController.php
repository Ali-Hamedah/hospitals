<?php

namespace App\Http\Controllers\Dashboard;

use Doctors;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

class DoctorController extends Controller
{

    private $doctors;

    public function __construct(DoctorRepositoryInterface $doctors)
    {
        $this->doctors = $doctors;
    }


    public function index()
    {
        $doctors = Doctor::all();

        return  $this->doctors->index();
    }


    public function create()
    {
        $sections = Section::all();
        return  $this->doctors->create();
    }



    public function store(Request $request)
    {
       return $this->doctors->store($request);

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->doctors->edit($id);
    }


    public function update(Request $request)
    {
        return $this->doctors->update($request);
    }


    public function destroy(Request $request)
    {
       return $this->doctors->destroy($request);
    }


    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        return $this->doctors->update_password($request);
    }

    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->doctors->update_status($request);
    }

}
