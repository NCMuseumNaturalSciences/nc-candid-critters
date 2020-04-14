<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryAssignUser extends Model
{
    protected $table = 'library_assign_user';
    protected $guarded = ['id'];

    public function library()
    {
        return $this->belongsTo('App\Library');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
