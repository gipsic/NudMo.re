<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id', 'phone_number', 'message',
    ];

    public function notification()
    {
        return $this->belongsTo('App\Notifications');
    }
}
