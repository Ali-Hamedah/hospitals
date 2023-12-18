<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ray_employeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ray_employees')->delete();

        DB::table('ray_employees')->insert([
            'name' => 'employees',
            'email' => 'employees@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
        ]);
    }
}
