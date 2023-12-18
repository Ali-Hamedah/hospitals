<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->delete();

        $SingleService = new Service();
        $SingleService->price = 500;
        $SingleService->status = 1;
        $SingleService->save();

        // store trans
        $SingleService->name = 'كشف';
        $SingleService->save();
    }
}
