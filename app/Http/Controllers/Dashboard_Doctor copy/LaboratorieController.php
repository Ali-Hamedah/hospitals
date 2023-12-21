<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Models\Laboratorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;

class LaboratorieController extends Controller
{

    private $Laboratorie;

    public function __construct(LaboratoriesRepositoryInterface $Laboratorie)
    {
        $this->Laboratorie = $Laboratorie;
    }


    public function index()
    {
        return $this->Laboratorie->index();
    }




    public function store(Request $request)
    {
        return $this->Laboratorie->store($request);
    }







    public function update(Request $request, $id)
    {
        return $this->Laboratorie->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->Laboratorie->store($id);
    }

    public function show($id)
    {
        return $this->Laboratorie->show($id);
    }

}
