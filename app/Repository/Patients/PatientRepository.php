<?php


namespace App\Repository\Patients;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\Patients\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{

    function index()
{
    $patients = Patient::all();
return view('Dashboard.Patients.index',  compact('patients'));
 }
function create()
{
return view('Dashboard.Patients.create');
}
function store($request)
{
    DB::beginTransaction();

    try {

        $patients = new Patient();
        $patients->email =  $request->email;
        $patients->Date_Birth = $request->Date_Birth;
        $patients->Blood_Group =  $request->Blood_Group;
        $patients->Phone = $request->Phone;
        $patients->Password = Hash::make($request->Phone);
        $patients->Gender = 1;
        $patients->save();
        // store trans
        $patients->name = $request->name;
        $patients->Address = $request->Address;
        $patients->save();

        DB::commit();
        session()->flash('add');
        return redirect()->route('Patients.create');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}
function edit($id)
{
    $Patient = Patient::findOrFail($id);
return view('Dashboard.Patients.edit',compact('Patient'));
}
function update($request)
{
    if (!$request->has('Gender'))
    $request->request->add(['Gender' => 2]);
else
    $request->request->add(['Gender' => 1]);

$patients = Patient::findOrFail($request->id);

$patients->update($request->all());

// insert trans
$patients->name = $request->name;
$patients->Address = $request->Address;
$patients->save();

session()->flash('edit');
return redirect()->route('Patients.index');
}
function destroy($request)
{
    Patient::destroy($request->id);
    session()->flash('delete');
    return redirect()->back();
}


}
