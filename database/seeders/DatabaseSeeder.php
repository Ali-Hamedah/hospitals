<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PatientTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserTableSeeder::class,
            AdminTableSeeder::class,
            //AppointmentSeeder::class,
            SectionTableSeeder::class,
            DoctorTableSeeder::class,
            ImageTableSeeder::class,
            PatientTableSeeder::class,
            ServiceTableSeeder::class,
            ray_employeeTableSeeder::class,

        ]);
    }
}
