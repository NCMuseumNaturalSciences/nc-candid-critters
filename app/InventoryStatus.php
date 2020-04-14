<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStatus extends Model
{
    protected $table = 'inventory_status';
    protected $guarded = ['id'];
    public function inventories()
    {
        return $this->hasMany('App\Inventory', 'status_id');
    }
}
