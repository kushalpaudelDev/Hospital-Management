<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Prescription;
use App\Models\PrescriptionItem;

class BillingService
{
    public static function generateFromPrescription(Prescription $prescription): Bill
    {
        $subtotal = 0;
        
        // Calculate from prescription items
        foreach ($prescription->items as $item) {
            $medicine = $item->medicine;
            $subtotal += $medicine->unit_price * $item->quantity;
        }

        // Add consultation fee
        $consultationFee = $prescription->doctor->consultation_fee;
        $subtotal += $consultationFee;

        $taxRate = 0.13; // 13% VAT in Nepal
        $taxAmount = $subtotal * $taxRate;
        $totalAmount = $subtotal + $taxAmount;

        return Bill::create([
            'bill_number' => 'BILL-' . date('Y') . '-' . str_pad(Bill::count() + 1, 4, '0', STR_PAD_LEFT),
            'patient_id' => $prescription->patient_id,
            'appointment_id' => $prescription->medicalRecord->appointment_id ?? null,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount' => 0,
            'total_amount' => $totalAmount,
            'paid_amount' => 0,
            'status' => 'pending',
            'bill_date' => now(),
        ]);
    }
}
