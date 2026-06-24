<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_id', 'first_name', 'last_name', 'email', 'phone',
        'date_of_birth', 'gender', 'blood_group', 'address',
        'emergency_contact_name', 'emergency_contact_phone',
        'allergies', 'chronic_diseases', 'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function bills(): HasMany
    {
        return $this->hasMany(Bill::class);
    }

    public function medicalHistories(): HasMany
    {
        return $this->hasMany(PatientMedicalHistory::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
