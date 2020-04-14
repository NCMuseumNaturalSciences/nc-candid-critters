<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    protected $table = 'deployments';
    protected $guarded = ['id'];

    public function volunteers()
    {
        return $this->belongsTo('App\Volunteer', 'volunteer_id');
    }
    public function description()
    {
        return $this->belongsTo('App\SiteDescription');
    }
}
