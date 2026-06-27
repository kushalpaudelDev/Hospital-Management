<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            PatientSeeder::class,
            DoctorSeeder::class,
            AppointmentSeeder::class,
            MedicineCategorySeeder::class,
            MedicineSeeder::class,
        ]);
    }
}
