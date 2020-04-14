<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use FullTextSearch;
    protected $table = 'cameras';
    protected $guarded = ['id'];

    protected $searchable = [
        'make',
        'model',
    ];

    public function volunteers()
    {
        return $this->hasMany('App\Volunteer');
    }
    public function inventories()
    {
        return $this->hasMany('App\Inventory');
    }
    public function descriptions()
    {
        return $this->hasMany('App\SiteDescription');
    }
}
