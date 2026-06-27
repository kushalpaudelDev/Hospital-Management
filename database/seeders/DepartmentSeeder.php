<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Cardiology', 'code' => 'CARD', 'description' => 'Heart and cardiovascular care'],
            ['name' => 'Neurology', 'code' => 'NEUR', 'description' => 'Brain and nervous system'],
            ['name' => 'Orthopedics', 'code' => 'ORTH', 'description' => 'Bones and joints'],
            ['name' => 'Pediatrics', 'code' => 'PEDI', 'description' => 'Children healthcare'],
            ['name' => 'General Medicine', 'code' => 'GENM', 'description' => 'General health checkups'],
            ['name' => 'Emergency', 'code' => 'EMER', 'description' => 'Emergency and trauma care'],
            ['name' => 'Dermatology', 'code' => 'DERM', 'description' => 'Skin care'],
            ['name' => 'Ophthalmology', 'code' => 'OPHT', 'description' => 'Eye care'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
