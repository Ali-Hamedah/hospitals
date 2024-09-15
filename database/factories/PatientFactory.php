<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Patient::class;

    public function definition()
    {

        return [

            'name' => $this->faker->name,
            'Address' => $this->faker->paragraph($numberOfWords = 1), // تحديد عدد الكلمات في العنوان (هنا 10 كلمات)
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // كلمة المرور
            'phone' => $this->faker->phoneNumber,
            'Date_Birth' => $this->faker->dateTimeBetween('1950-01-01', 'now-18years')->format('Y-m-d'),
            'Gender' => $this->faker->randomElement(['  دكر', ' انثى']),
            'Blood_Group' =>$this->faker->randomElement(['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-']),
        ];
    }
}
