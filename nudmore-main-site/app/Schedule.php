<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_number', 'date_time',
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
}
