<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->delete();
        $doctors =  Doctor::factory()->count(30)->create();
        $Appointments = Appointment::all();

//        foreach ($doctors as $doctor){
//            $Appointments = Appointment::all()->random()->id;
//            $doctor->doctorappointments()->attach($Appointments);
//        }
        Doctor::all()->each(function ($doctor) use ($Appointments) {
           $doctor->doctorappointments()->attach(
              $Appointments->random(rand(1,7))->pluck('id')->toArray()
           );
       });


}
}
