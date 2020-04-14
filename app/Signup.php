<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $table = 'signups';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function volunteer()
    {
        return $this->hasOne('App\Volunteer');
    }
    public function trainingStatus()
    {
        return $this->belongsTo('App\TrainingStatus');
    }
}
