<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingStatus extends Model
{
    protected $table = 'training_status';
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];

    public function signups()
    {
        return $this->hasMany('App\Signup','training_status_id');
    }
}
