<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'doctor_number',
    ];

    public function schedule()
    {
        return $this->hasMany('App\Schedule', 'doctor_number', 'doctor_number');
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
