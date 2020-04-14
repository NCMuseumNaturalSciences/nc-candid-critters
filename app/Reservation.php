<?php

namespace App;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $guarded = ['id'];
    protected $dates = ['open_date','close_date','created_at','updated_at'];


    public function scopeOpen($query){
        return $query->where('status_id', '=', 1);
    }
    public function scopeClosed($query){
        return $query->where('status_id', '=', 2);
    }

    public function status()
    {
        return $this->belongsTo('App\ReservationStatus', 'status_id');
    }
    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer');
    }
    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }

    public static function getOpen()
    {
        $reservations = Reservation::where('closed_yn','=',0)->get();
        return $reservations;
    }
    public static function getClosed()
    {
        $reservations = Reservation::where('closed_yn','=',1)->get();
        return $reservations;
    }

    public static function getMyReservations()
    {
        $userid = Auth::user()->getId();
        $reservations = DB::table('reservations')
            ->join('inventories','reservations.inventory_id','=','inventories.id')
            ->join('libraries','inventories.library_id','=','libraries.id')
            ->join('library_assign_user','libraries.id','=','library_assign_user.library_id')
            ->join('users','library_assign_user.user_id','=','users.id')
            ->where('users.id','=',$userid);
        return $reservations;
    }

}
