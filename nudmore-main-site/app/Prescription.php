<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_number', 'date-time',
    ];

    public function dispense()
    {
        return $this->hasMany('App\Dispense', 'diepense_id','id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_number', 'patient_number');
    }
}
