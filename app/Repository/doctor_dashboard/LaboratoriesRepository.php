<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\LaboratoriesRepositoryInterface;
use App\Models\Laboratorie;



class LaboratoriesRepository implements LaboratoriesRepositoryInterface
{
    // Get All insurance
    public function index()
    {


    }




    public function store($request)
    {
        try {
            Laboratorie::create([
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
         $Laboratories =  Laboratorie::findOrFail($id);
         $Laboratories->update([
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
            Laboratorie ::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        $laboratories = Laboratorie::findorFail($id);

        if ($laboratories->doctor_id  == auth()->user()->id) {
            return view('Dashboard.doctor.invoices.view_laboratorie', compact('laboratories'));
        }
        return redirect()->route('404');
    }

}
