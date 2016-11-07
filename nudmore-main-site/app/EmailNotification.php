<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id', 'email_address', 'topic', 'detail',
    ];

    public function notification()
    {
        return $this->belongsTo('App\Notifications');
    }
}
