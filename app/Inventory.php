<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use DB;
class Inventory extends Model
{
    protected $table = 'inventories';
    protected $guarded = ['id'];


    public function scopeAvailable($query){
        return $query->where('status_id', '=', 1);
    }
    public function scopeUnavailable($query){
        return $query->where('status_id', '<>', 1);
    }
    public function scopeReserved($query){
        return $query->where('status_id', '=', 2);
    }
    public function status()
    {
        return $this->belongsTo('App\InventoryStatus', 'status_id');
    }
    public function camera()
    {
        return $this->belongsTo('App\Camera');
    }
    public function library()
    {
        return $this->belongsTo('App\Library');
    }
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public static function getMyInventory()
    {
        $userid = Auth::user()->getId();
        $inventory = DB::table('inventories')
            ->join('libraries','inventories.library_id','=','libraries.id')
            ->join('library_assign_user','libraries.id','=','library_assign_user.library_id')
            ->join('users','library_assign_user.user_id','=','users.id')
            ->where('users.id','=',$userid)
            ->get();
        return $inventory;
    }

    /**
     * Get the Inventory of a Library by Library ID ($id)
     */
    public static function getLibraryInventory($id)
    {
        $inventory = Inventory::where('library_id','=',$id)->with('status');
        return $inventory->get();
    }
}
