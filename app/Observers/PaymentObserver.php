<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Bill;

class PaymentObserver
{
    public function created(Payment $payment): void
    {
        $bill = $payment->bill;
        $totalPaid = $bill->payments->sum('amount');
        $bill->paid_amount = $totalPaid;
        
        if ($totalPaid >= $bill->total_amount) {
            $bill->status = 'paid';
        } elseif ($totalPaid > 0) {
            $bill->status = 'partial';
        }
        
        $bill->save();
    }
}
