<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DispensedMedicine extends Model
{
    protected $fillable = [
        'prescription_id', 'medicine_id', 'quantity', 'dispensed_at',
    ];

    protected $casts = [
        'dispensed_at' => 'datetime',
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
