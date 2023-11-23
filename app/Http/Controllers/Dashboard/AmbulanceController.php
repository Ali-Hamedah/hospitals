<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;


class AmbulanceController extends Controller
{
    private $ambulances;

    public function __construct(AmbulanceRepositoryInterface $ambulances)
    {
        $this->ambulances = $ambulances;
    }
    public function index()
    {
        return $this->ambulances->index();
    }


    public function create()
    {
        return $this->ambulances->create();
    }


    public function store(StoreAmbulanceRequest $request)
    {
        return $this->ambulances->store($request);
    }


    public function edit($id)
    {
        return $this->ambulances->edit($id);
    }

    public function update(StoreAmbulanceRequest $request)
    {
        return $this->ambulances->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->ambulances->destroy($request);
    }
}
