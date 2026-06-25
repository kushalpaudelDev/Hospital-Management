<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // Create users for doctors first
        $doctorUsers = [
            [
                'name' => 'Dr. Prakash Joshi',
                'email' => 'dr.prakash@hospital.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dr. Anjali Karki',
                'email' => 'dr.anjali@hospital.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dr. Binod Thapa',
                'email' => 'dr.binod@hospital.com',
                'password' => Hash::make('password'),
            ],
        ];

        $departments = Department::all();

        foreach ($doctorUsers as $index => $userData) {
            $user = User::create($userData);

            Doctor::create([
                'user_id' => $user->id,
                'department_id' => $departments[$index]->id,
                'specialization' => match($index) {
                    0 => 'Cardiologist',
                    1 => 'Neurologist',
                    2 => 'Orthopedic Surgeon',
                },
                'license_number' => 'NMC-' . (1000 + $index),
                'qualification' => 'MBBS, MD',
                'experience_years' => 10 + $index * 2,
                'consultation_fee' => 500 + ($index * 200),
                'phone' => '981000000' . ($index + 1),
                'address' => 'Kathmandu, Nepal',
                'is_available' => true,
            ]);
        }
    }
}