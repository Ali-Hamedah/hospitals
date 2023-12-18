<?php

namespace App\Repository\RayEmployees;

use App\Models\RayEmployee;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\RayEmployees\RayEmployeeRepositoryInterface;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $RayEmployees = RayEmployee::all();
        return view('Dashboard.RayEmployees.index', compact('RayEmployees'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $rayEmployee = new RayEmployee();
            $rayEmployee->name = $request->name;
            $rayEmployee->email = $request->email;
            $rayEmployee->password = Hash::make($request->password);
            $rayEmployee->save();

            //Upload img
            $this->verifyAndStoreImage($request, 'photo', 'ray_employees', 'upload_image', $rayEmployee->id, 'App\Models\RayEmployee');
            DB::commit();
            session()->flash('add');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id)
    {

        try {
            $rayEmployee = RayEmployee::findOrFail($id);
            $rayEmployee->name = $request->name;
            $rayEmployee->email = $request->email;
            $rayEmployee->password = Hash::make($request->password);
            $rayEmployee->save();




            session()->flash('edit');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
    }

    public function destroy($id)
    {
        RayEmployee::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
