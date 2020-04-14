<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryVolunteerAssignment extends Model
{
    protected $table = 'library_volunteer_assignments';
    protected $guarded = ['id'];

    public function library()
    {
        return $this->belongsTo('App\Library', 'library_id');
    }
    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer','volunteer_id');
    }

}
