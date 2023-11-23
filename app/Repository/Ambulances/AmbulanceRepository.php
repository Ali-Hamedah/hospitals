<?php

namespace App\Repository\Ambulances;

use App\Models\Ambulance;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    // Get All insurance
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('Dashboard.Ambulances.index', compact('ambulances'));
    }

    // Create New insurance
    public function create()
    {
        return view('Dashboard.Ambulances.create');
    }

    // Store new insurance
    public function store($request)
    {
        DB::beginTransaction();

        try {

            $ambulances = new Ambulance();
            $ambulances->car_number = $request->car_number;
            $ambulances->car_model =  $request->car_model;
            $ambulances->car_year_made = $request->car_year_made;
            $ambulances->driver_license_number =  $request->driver_license_number;
            $ambulances->driver_phone = $request->driver_phone;
            $ambulances->car_type = 1;
            $ambulances->save();
            // store trans
            $ambulances->driver_name = $request->driver_name;
            $ambulances->notes = $request->notes;
            $ambulances->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('ambulance.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // edit insurance
    public function edit($id)
    {

        $ambulance  = Ambulance::findorfail($id);
        return view('Dashboard.Ambulances.edit', compact('ambulance'));
    }

    // update insurance
    public function update($request)
    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);

        $ambulance = Ambulance::findOrFail($request->id);

        $ambulance->update($request->all());

        // insert trans
        $ambulance->driver_name = $request->driver_name;
        $ambulance->notes = $request->notes;
        $ambulance->save();

        session()->flash('edit');
        return redirect()->route('ambulance.index');
    }

    // Deleted insurance
    public function destroy($request)
    {
        Ambulance::destroy($request->id);
        session()->flash('delete');
        return redirect()->back();
    }
}
