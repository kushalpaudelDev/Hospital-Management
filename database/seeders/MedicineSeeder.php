<?php

namespace Database\Seeders;

use App\Models\Medicine;
use App\Models\MedicineCategory;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $categories = MedicineCategory::all();

        $medicines = [
            [
                'name' => 'Amoxicillin 500mg',
                'generic_name' => 'Amoxicillin',
                'sku' => 'MED-001',
                'category_id' => $categories[0]->id,
                'manufacturer' => 'Sun Pharma',
                'unit' => 'tablet',
                'stock_quantity' => 500,
                'unit_price' => 15.00,
                'expiry_date' => '2026-12-01',
                'is_active' => true,
            ],
            [
                'name' => 'Paracetamol 500mg',
                'generic_name' => 'Paracetamol',
                'sku' => 'MED-002',
                'category_id' => $categories[1]->id,
                'manufacturer' => 'Cipla',
                'unit' => 'tablet',
                'stock_quantity' => 1000,
                'unit_price' => 8.00,
                'expiry_date' => '2027-06-01',
                'is_active' => true,
            ],
            [
                'name' => 'Vitamin C 1000mg',
                'generic_name' => 'Ascorbic Acid',
                'sku' => 'MED-003',
                'category_id' => $categories[2]->id,
                'manufacturer' => 'Dabur',
                'unit' => 'tablet',
                'stock_quantity' => 300,
                'unit_price' => 25.00,
                'expiry_date' => '2026-09-01',
                'is_active' => true,
            ],
        ];

        foreach ($medicines as $med) {
            Medicine::create($med);
        }
    }
}