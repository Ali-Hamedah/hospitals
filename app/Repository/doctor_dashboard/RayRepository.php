<?php

namespace App\Repository\doctor_dashboard;



use App\Models\Ray;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Interfaces\doctor_dashboard\RayRepositoryInterface;


class RayRepository implements RayRepositoryInterface
{
    // Get All insurance
    public function index()
    {
        return 'jsds';
    }




    public function store($request)
    {
        try {
            Ray::create([
                'description'=>$request->description,
                'invoice_id'=>$request->invoice_id,
                'patient_id'=>$request->patient_id,
                'doctor_id'=>$request->doctor_id,
            ]);
            session()->flash('add');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }







    public function update($request, $id)
    {
        try {


            $rays = Ray::findOrFail($id);
            $rays->update([
            'description' => $request->input('description'),
        ]);
            session()->flash('edit');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        try {
            Ray ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    }



