<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'patient_number', 'blood_type', 'birthdate', 'address', 'phone_number', 'drug_allergy',
    ];

    public function record()
    {
        return $this->hasMany('App\Record');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Appointment');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
