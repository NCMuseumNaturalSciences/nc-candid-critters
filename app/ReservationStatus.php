<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    protected $table = 'reservations_status';
    protected $guarded = ['id'];

    public function reservations()
    {
        return $this->hasMany('App\Reservation', 'status_id');
    }
}
