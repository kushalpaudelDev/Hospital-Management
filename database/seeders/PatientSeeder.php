<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'patient_id' => 'P-2024-001',
                'first_name' => 'Ram',
                'last_name' => 'Sharma',
                'email' => 'ram.sharma@email.com',
                'phone' => '9800000001',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'blood_group' => 'A+',
                'address' => 'Kathmandu, Nepal',
                'emergency_contact_name' => 'Sita Sharma',
                'emergency_contact_phone' => '9800000011',
                'allergies' => 'Penicillin',
                'chronic_diseases' => 'Diabetes',
                'status' => 'active',
            ],
            [
                'patient_id' => 'P-2024-002',
                'first_name' => 'Sita',
                'last_name' => 'Gurung',
                'email' => 'sita.gurung@email.com',
                'phone' => '9800000002',
                'date_of_birth' => '1985-08-20',
                'gender' => 'female',
                'blood_group' => 'B+',
                'address' => 'Pokhara, Nepal',
                'emergency_contact_name' => 'Hari Gurung',
                'emergency_contact_phone' => '9800000022',
                'allergies' => null,
                'chronic_diseases' => 'Hypertension',
                'status' => 'active',
            ],
            [
                'patient_id' => 'P-2024-003',
                'first_name' => 'Hari',
                'last_name' => 'Paudel',
                'email' => 'hari.paudel@email.com',
                'phone' => '9800000003',
                'date_of_birth' => '1995-03-10',
                'gender' => 'male',
                'blood_group' => 'O+',
                'address' => 'Lalitpur, Nepal',
                'emergency_contact_name' => 'Gita Paudel',
                'emergency_contact_phone' => '9800000033',
                'allergies' => 'Dust',
                'chronic_diseases' => null,
                'status' => 'active',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
