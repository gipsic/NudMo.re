<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scheduled_timestamp',
    ];

    /**
     * Relationship assignment
     */

    public function email()
    {
        return $this->hasOne('App\EmailNotification');
    }

    public function sms()
    {
        return $this->hasOne('App\SmsNotification');
    }

    /**
     * Determine notification type
     */

    public function isEmailNotification()
    {
        return $this->emailNotification !== null;
    }

    public function isSmsNotification()
    {
        return $this->smsNotification !== null;
    }
}
