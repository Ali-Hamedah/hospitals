<?php

namespace App\Repository\Dashboard_Laboratorie_Employee;

use App\Models\Ray;
use App\Models\Invoice;
use App\Traits\UploadTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Interfaces\Dashboard_Laboratorie_Employee\InvoicesRepositoryInterface;
use App\Models\Laboratorie;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    use UploadTrait;

    public function index()
    {
        $invoices = Laboratorie::where('case', 0)->get();
        return view('Dashboard.Dashboard_Laboratorie_Employee.Invoices.index', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Laboratorie::findorFail($id);
        return view('Dashboard.Dashboard_Laboratorie_Employee.Invoices.add', compact('invoice'));
    }

    public function update($request, $id)
    {
        $invoice = Laboratorie::findorFail($id);

        $invoice->update([
            'employee_id' => auth()->user()->id,
            'description_employee' => $request->description_employee,
            'case' => 1,
        ]);

        if ($request->hasFile('photos')) {

            foreach ($request->photos as $photo) {
                //Upload img
                $this->verifyAndStoreImageForeach($photo, 'laboratories', 'upload_image', $invoice->id, 'App\Models\Laboratorie');
            }

            session()->flash('edit');
            return redirect()->route('invoices_laboratorie_employee.index');
        }
    }

  
    public function completed_invoices()
    {
        $invoices = Laboratorie::where(['case' => 1, 'employee_id' => auth()->user()->id])->get();
        return view('Dashboard.Dashboard_Laboratorie_Employee.Invoices.completed_invoices', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Laboratorie::findorFail($id);

        if ($rays->employee_id == auth()->user()->id) {
            return view('Dashboard.Dashboard_Laboratorie_Employee.Invoices.view_rays', compact('rays'));
        }
        return redirect()->route('404');
    }
}
