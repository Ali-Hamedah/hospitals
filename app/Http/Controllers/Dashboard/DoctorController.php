<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Section;

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


    public function edit(Request $request)
    {
        return $this->doctors->edit($request);
    }


    public function update(Request $request, $id)
    {
        return $request;
    }


    public function destroy(Request $request)
    {
       return $this->doctors->destroy($request);
    }
}
