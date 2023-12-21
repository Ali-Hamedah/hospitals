<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\doctor_dashboard\RayRepositoryInterface;

class RayController extends Controller
{


    private $Ray;

    public function __construct(RayRepositoryInterface $Ray)
    {
        $this->Ray = $Ray;
    }

    public function index()
    {
        return $this->Ray->index();
    }

    public function store(Request $request)
    {
       return $this->Ray->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->Ray->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->Ray->destroy( $id);
    }
}
