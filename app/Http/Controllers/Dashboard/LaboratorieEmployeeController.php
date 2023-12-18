<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;

class LaboratorieEmployeeController extends Controller
{
    private $employee;

    public function __construct(LaboratorieEmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }


    public function index()
    {
     return  $this->employee->index();
    }

    public function store(Request $request)
    {
        return  $this->employee->store($request);
    }


    public function show($id)
    {
        return  $this->employee->show($id);
    }


    public function update(Request $request, $id)
    {
        return  $this->employee->update($request, $id);
    }


    public function destroy($id)
    {
        return  $this->employee->destroy($id);
    }
}
