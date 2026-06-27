<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $admin = User::first();

        $appointments = [
            [
                'appointment_number' => 'APT-2024-001',
                'patient_id' => $patients[0]->id,
                'doctor_id' => $doctors[0]->id,
                'appointment_date' => '2024-06-25',
                'appointment_time' => '10:00:00',
                'type' => 'consultation',
                'symptoms' => 'Chest pain, shortness of breath',
                'notes' => 'First visit',
                'status' => 'scheduled',
                'created_by' => $admin->id,
            ],
            [
                'appointment_number' => 'APT-2024-002',
                'patient_id' => $patients[1]->id,
                'doctor_id' => $doctors[1]->id,
                'appointment_date' => '2024-06-26',
                'appointment_time' => '14:00:00',
                'type' => 'follow_up',
                'symptoms' => 'Headache, dizziness',
                'notes' => 'Follow up after MRI',
                'status' => 'confirmed',
                'created_by' => $admin->id,
            ],
            [
                'appointment_number' => 'APT-2024-003',
                'patient_id' => $patients[2]->id,
                'doctor_id' => $doctors[2]->id,
                'appointment_date' => '2024-06-27',
                'appointment_time' => '09:30:00',
                'type' => 'consultation',
                'symptoms' => 'Knee pain, swelling',
                'notes' => 'Sports injury',
                'status' => 'scheduled',
                'created_by' => $admin->id,
            ],
        ];

        foreach ($appointments as $apt) {
            Appointment::create($apt);
        }
    }
}
