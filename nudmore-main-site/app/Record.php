<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_number', 'date_time', 'topic', 'detail', 'weight', 'height', 'temperature', 'heart_rate', 'systolic_blood_pressure', 'diastolic_blood_pressure', 'icd10',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_number', 'patient_number');
    }
}
