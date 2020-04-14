<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStatusTimestamp extends Model
{
    protected $table = 'inventory_status_timestamps';
    protected $guarded = ['id'];

    public function inventories()
    {
        return $this->belongsTo('App\Inventory', 'inventory_id');
    }
    public function status()
    {
        return $this->belongsTo('App\InventoryStatus', 'inventory_status_id');
    }
}
