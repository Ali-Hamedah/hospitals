<?php

namespace App\Http\Controllers\Dashboard\appointments;

use Twilio\Rest\Client;

use App\Mail\FirstEmail;
use App\Mail\MyTestMail;
use App\Models\Appointment;
use Facade\FlareClient\Api;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use App\Models\Invoice;
use App\Notifications\NewEmailNotification;

class AppointmentController extends Controller
{
    public function index(){

        $appointments = Appointment::where('type','غير مؤكد') ->orWhere('appointment_patient', '<', \Carbon\Carbon::today())
        ->get();
        return view('Dashboard.appointments.index',compact('appointments'));
    }

    public function indexConfirmed(){

        $appointments = Appointment::where('type','مؤكد')->get();
        return view('Dashboard.appointments.indexConfirmed',compact('appointments'));
    }

    public function indexExpired(){

        $appointments = Appointment::where('type', 'منتهي')
        ->orWhere('appointment_patient', '<', \Carbon\Carbon::today())
        ->get();
        return view('Dashboard.appointments.indexExpired',compact('appointments'));
    }


    public function approval(Request $request,$id){
        $appointment = Appointment::findorFail($id);
        $appointment->update([
            'type'=>'مؤكد',
            'appointment_patient'=>$request->appointment_patient,
            'time_patient'=>$request->time_patient
        ]);

        Mail::to($appointment->email)->send(new FirstEmail($appointment->name,$appointment->appointment));

        // $appointment->notify(new NewEmailNotification);

        // send message mob
        // $receiverNumber = $appointment->phone;
        // $message = "عزيزي المريض" . " " . $appointment->name . " " . "تم حجز موعدك بتاريخ " . $appointment->appointment;

        // $account_sid = getenv("TWILIO_SID");
        // $auth_token = getenv("TWILIO_TOKEN");
        // $twilio_number = getenv("TWILIO_FROM");
        // $client = new Client($account_sid, $auth_token);
        // $client->messages->create($receiverNumber,[
        //     'from' => $twilio_number,
        //     'body' => $message
        // ]);
        session()->flash('add');
        return back();
    }

    public function getAppointments($date)
{
    // جلب جميع الأوقات المحجوزة في التاريخ المحدد
    $appointments = Appointment::whereDate('appointment_patient', $date)->pluck('time_patient');

    // إرجاع المواعيد كـ JSON
    return response()->json($appointments);
}

    function destroy($id)
    {
        Appointment::findOrFail($id)->delete();
        session()->flash('delete');
        return redirect()->back();
    }

    public function deleteall()
    {

        $appointments = Appointment::where('type', 'منتهي')
        ->orWhere('appointment_patient', '<', \Carbon\Carbon::today())
        ->delete();
        session()->flash('delete');
        return redirect()->back();

    }

    public function showNotification($id, $notification_id)
    {
         // جلب الإشعار حسب المعرف الخاص به
         $notification = Notification::where('id', $notification_id)->first();
         if ($notification) {
            $notification->update([
                'reader_status' => 1
            ]);
        }
        $Invoice = Invoice::where('id', $id)->first();
        if ($Invoice) {
            return redirect()->route('single_invoices', ['id' => $Invoice->id]);
    }
}

}
