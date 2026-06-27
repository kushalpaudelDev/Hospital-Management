<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\Prescription;
use App\Observers\PaymentObserver;
use App\Observers\PrescriptionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Prescription::observe(PrescriptionObserver::class);
        Payment::observe(PaymentObserver::class);
    }
}
