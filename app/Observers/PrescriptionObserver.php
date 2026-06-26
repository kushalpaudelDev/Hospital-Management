<?php

namespace App\Observers;

use App\Models\Prescription;
use App\Services\BillingService;

class PrescriptionObserver
{
    public function created(Prescription $prescription): void
    {
        BillingService::generateFromPrescription($prescription);
    }
}
