<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'how_to_use',
    ];

    public function dispense()
    {
        return $this->hasMany('App\Dispense', 'medicine_id','id');
    }
}
