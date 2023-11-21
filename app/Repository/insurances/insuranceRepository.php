<?php
namespace App\Repository\insurances;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Interfaces\insurances\insuranceRepositoryInterface;

class insuranceRepository implements insuranceRepositoryInterface
{
    function index()
    {
        $insurances = Insurance::all();
return view('Dashboard.insurance.index', compact('insurances'));
    }
function create()
{

    return view('Dashboard.insurance.create');
}

function store( $request)
{
    DB::beginTransaction();

    try {

        $insurances = new Insurance();
        $insurances->insurance_code = $request->insurance_code;
        $insurances->discount_percentage =  $request->discount_percentage;
        $insurances->Company_rate = $request->Company_rate;
        $insurances->status = 1;
        $insurances->save();
        // store trans
        $insurances->name = $request->name;
        $insurances->notes = $request->notes;
        $insurances->save();

        DB::commit();
        session()->flash('add');
        return redirect()->route('insurance.create');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

function edit($id)
{
    $insurances = Insurance::findorfail($id);
    return view('Dashboard.insurance.edit',compact('insurances'));
}

function update($request)
{
    if (!$request->has('status'))
    $request->request->add(['status' => 0]);
else
    $request->request->add(['status' => 1]);

$insurances = insurance::findOrFail($request->id);

$insurances->update($request->all());

// insert trans
$insurances->name = $request->name;
$insurances->notes = $request->notes;
$insurances->save();

session()->flash('edit');
return redirect('insurance');
}

function destroy($request)
{
    Insurance::findOrFail($request->id)->delete();
    session()->flash('delete');
    return redirect()->route('insurance.index');
}
}
