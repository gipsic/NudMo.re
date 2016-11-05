<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'email', 'title', 'name', 'surname', 'gender', 'identity_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship assignment
     */

    public function patient()
    {
        return $this->hasOne('App\Patient');
    }

    public function doctor()
    {
        return $this->hasOne('App\Doctor');
    }

    public function staff()
    {
        return $this->hasOne('App\Staff');
    }

    public function nurse()
    {
        return $this->hasOne('App\Nurse');
    }

    public function pharmacist()
    {
        return $this->hasOne('App\Pharmacist');
    }

    public function administrator()
    {
        return $this->hasOne('App\Administrator');
    }

    /**
     * Determine user role
     */

    public function isPatient()
    {
        return $this->patient !== null;
    }

    public function isDoctor()
    {
        return $this->doctor !== null;
    }

    public function isStaff()
    {
        return $this->staff !== null;
    }

    public function isNurse()
    {
        return $this->nurse !== null;
    }

    public function isPharmacist()
    {
        return $this->pharmacist !== null;
    }

    public function isAdministrator()
    {
        return $this->administrator !== null;
    }

    /**
     * Mutators
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
