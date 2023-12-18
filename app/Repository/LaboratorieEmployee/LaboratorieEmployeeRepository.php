<?php
namespace App\Repository\LaboratorieEmployee;

use App\Traits\UploadTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\LaboratorieEmployee;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\LaboratorieEmployee\LaboratorieEmployeeRepositoryInterface;

class LaboratorieEmployeeRepository implements LaboratorieEmployeeRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $employees = LaboratorieEmployee::all();
        return view('Dashboard.LaboratorieEmployee.index', compact('employees'));
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            $rayEmployee = new LaboratorieEmployee();
            $rayEmployee->name = $request->name;
            $rayEmployee->email = $request->email;
            $rayEmployee->password = Hash::make($request->password);
            $rayEmployee->save();

            //Upload img
            $this->verifyAndStoreImage($request, 'photo', 'laboratorie_employees', 'upload_image', $rayEmployee->id, 'App\Models\LaboratorieEmployee');
            DB::commit();
            session()->flash('add');
            return redirect()->route('laboratorie_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }

    public function update($request, $id)
    {
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = LaboratorieEmployee::find($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }


    public function destroy($id)
    {
        LaboratorieEmployee::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }


}
