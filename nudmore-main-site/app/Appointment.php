<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_number', 'doctor_number', 'date_time', 'reason', 'notification_id',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_number', 'patient_number');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor', 'doctor_number', 'doctor_number');
    }
}
