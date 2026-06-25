<?php

namespace Database\Seeders;

use App\Models\MedicineCategory;
use Illuminate\Database\Seeder;

class MedicineCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Antibiotics', 'code' => 'ANTB', 'description' => 'Infection fighting medicines'],
            ['name' => 'Pain Relief', 'code' => 'PAIN', 'description' => 'Pain killers and analgesics'],
            ['name' => 'Vitamins', 'code' => 'VITA', 'description' => 'Vitamin supplements'],
            ['name' => 'Cardiac', 'code' => 'CARD', 'description' => 'Heart medicines'],
            ['name' => 'Diabetes', 'code' => 'DIAB', 'description' => 'Diabetes management'],
        ];

        foreach ($categories as $cat) {
            MedicineCategory::create($cat);
        }
    }
}