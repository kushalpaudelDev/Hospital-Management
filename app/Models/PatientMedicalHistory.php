<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientMedicalHistory extends Model
{
    protected $fillable = [
        'patient_id', 'condition', 'description',
        'diagnosed_date', 'status', 'treatment'
    ];

    protected $casts = [
        'diagnosed_date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
