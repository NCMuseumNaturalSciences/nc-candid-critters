<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryCheck extends Model
{
    protected $table = 'inventory_checks';
    protected $guarded = ['id'];
    public function inventory()
    {
        return $this->belongsTo('App\Inventory', 'inventory_id');
    }
}
