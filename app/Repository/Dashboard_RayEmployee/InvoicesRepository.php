<?php

namespace App\Repository\Dashboard_RayEmployee;

use App\Models\Ray;
use App\Models\Invoice;
use App\Traits\UploadTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Interfaces\Dashboard_RayEmployee\InvoicesRepositoryInterface;

class InvoicesRepository implements InvoicesRepositoryInterface
{

    use UploadTrait;

    public function index()
    {
        $invoices = Ray::where('case', 0)->get();
        return view('Dashboard.dashboard_RayEmployee.Invoices.index', compact('invoices'));
    }

    public function edit($id)
    {
        $invoice = Ray::findorFail($id);
        return view('Dashboard.dashboard_RayEmployee.invoices.add_diagnosis', compact('invoice'));
    }

    public function update($request, $id)
    {
        $invoice = Ray::findorFail($id);

        $invoice->update([
            'employee_id' => auth()->user()->id,
            'description_employee' => $request->description_employee,
            'case' => 1,
        ]);

        if ($request->hasFile('photos')) {

            foreach ($request->photos as $photo) {
                //Upload img
                $this->verifyAndStoreImageForeach($photo, 'Rays', 'upload_image', $invoice->id, 'App\Models\Ray');
            }

            session()->flash('edit');
            return redirect()->route('invoices_ray_employee.index');
        }
    }

    public function destroy($id)
    {
        // Invoice::findOrFail($id)->delete();
        // session()->flash('delete');
        // return redirect()->route('invoices.index');
    }

    public function completed_invoices()
    {
        $invoices = Ray::where(['case' => 1, 'employee_id' => auth()->user()->id])->get();
        return view('Dashboard.dashboard_RayEmployee.Invoices.completed_invoices', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Ray::findorFail($id);

        if ($rays->employee_id == auth()->user()->id) {
            return view('Dashboard.dashboard_RayEmployee.Invoices.view_rays', compact('rays'));
        }
        return redirect()->route('404');
    }
}
