<?php

namespace App\Http\Livewire\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Livewire\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $appointment_patient;
    public $time_patient;
    public $existingAppointments;
    public $message = false;
    public $messageEmpty = false;
    public $isDateReserved = false;
    public $isTimeReserved = false;
    public $isTimeFieldDisabled = false;

    public function mount()
    {
        $this->sections = Section::get();
        $this->doctors = collect();
    }

    public function render()
    {
        return view('livewire.appointments.create', [
            'sections' => Section::get(),
        ]);
    }

    public function updatedSection($section_id)
    {
        $this->doctors = Doctor::where('section_id', $section_id)->get();
    }

    public function updatedAppointmentPatient()
    {
        // التحقق من اختيار دكتور قبل تاريخ
        if (empty($this->doctor)) {
            // عرض رسالة خطأ للمستخدم
            $this->messageEmpty = true;
        } else {
            // احصل على عدد الحجوزات المحجوزة للدكتور في التاريخ المحدد
            $appointmentsCount = Appointment::where('doctor_id', $this->doctor)
                ->where('appointment_patient', $this->appointment_patient)
                ->count();

            // احصل على عدد الحجوزات المتاحة للدكتور في يوم معين
            $doctor_info = Doctor::find($this->doctor);
            $availableAppointments = $doctor_info->number_of_statements - $appointmentsCount;

            // التحقق من أن التاريخ ليس قديمًا (أكبر من تاريخ اليوم)
            if ($this->appointment_patient >= now()->toDateString()) {
                if ($availableAppointments > 0) {
                    // تحديث حالة تفعيل/تعطيل حقل الوقت استنادًا إلى حالة حجز التاريخ
                    $this->isTimeFieldDisabled = false;
                    // حينما يتم اختيار تاريخ جديد غير محجوز، قم بتحديث $isDateReserved ليكون false
                    $this->isDateReserved = false;
                } else {
                    // إذا لم يكن هناك حجوزات متاحة، قم بتحديث $isDateReserved وعرض رسالة الخطأ
                    $this->isDateReserved = true;
                    // حالة تعطيل حقل الوقت لأنه لا يوجد حجوزات متاحة
                    $this->isTimeFieldDisabled = true;
                }
            } else {
                // إذا كان التاريخ ما قبل اليوم، قم بتعيين حالة تعطيل حقل الوقت
                $this->isTimeFieldDisabled = true;
                // وحالة حجز التاريخ لعرض رسالة الخطأ
                $this->isDateReserved = true;
            }
        }
    }


    public function updatedTimePatient()
    {
        // احصل على التاريخ المحدد من حقل تاريخ الموعد
        $selectedDate = new \DateTime($this->appointment_patient);
        // احصل على التاريخ والوقت المحدد ككل
        $selectedDateTime = new \DateTime($this->appointment_patient . ' ' . $this->time_patient);
        // احصل على قائمة الحجوزات في نفس التاريخ والوقت
        $this->existingAppointments = Appointment::whereDate('appointment_patient', $selectedDate->format('Y-m-d'))
            ->where('doctor_id', $this->doctor)
            ->where('time_patient', $this->time_patient)
            ->exists();
        if ($this->existingAppointments) {
            // إذا كان الوقت محجوز، ضبط الرسالة الخطأ
            $this->isTimeReserved = true;
        } else {
            // إذا كان الوقت غير محجوز، ضبط رسالة نجاح (أو تركها فارغة)
            $this->isTimeReserved = false;
        }
    }

    public function checkIfTimeReserved($doctorId, $date, $time)
    {
        // احصل على التاريخ المحدد
        $selectedDate = new \DateTime($date);

        // احصل على قائمة الحجوزات في نفس التاريخ والوقت
        $existingAppointments = Appointment::whereDate('appointment_patient', $selectedDate->format('Y-m-d'))
            ->where('doctor_id', $doctorId)
            ->where('time_patient', $time)
            ->exists();

        // إذا كان الوقت محجوز، قم بإرجاع لون أحمر، وإلا قم بإرجاع لون اخضر
        return $existingAppointments ? 'disabled' : 'green';
    }



    public function store()
    {

        $this->validate([
            // 'email' => 'required|unique:appointments,email,' . $this->id,
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);

        //chek number_of_statements
        $appointment_count = Appointment::where('doctor_id', $this->doctor)->where('appointment_patient', $this->appointment_patient)->count();
        $doctor_info = Doctor::find($this->doctor);

        $selectedDate = new \DateTime($this->appointment_patient);
        $existingAppointments = Appointment::whereDate('appointment_patient', $selectedDate->format('Y-m-d'))
            ->where('doctor_id', $this->doctor)
            ->where('time_patient', $this->time_patient)
            ->exists();

        if ($appointment_count == $doctor_info->number_of_statements || $selectedDate == $existingAppointments) {
            $this->isTimeReserved = true;
            return;
        }
        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->appointment_patient = $this->appointment_patient;
        $appointments->time_patient = $this->time_patient;
        $appointments->save();

        $this->message = true;
    }
}
