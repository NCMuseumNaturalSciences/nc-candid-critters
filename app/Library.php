<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'libraries';
    protected $guarded = ['id'];

    public function inventory()
    {
        return $this->hasMany('App\Inventory');
    }
    public function assignments()
    {
        return $this->hasMany('App\LibraryVolunteerAssignment','library_id');
    }
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }


    public static function getUnassigned(){
        $libraries = Library::all();
        $unassigned = User::whereNotExists( function ($query) use ($libraries)  {
            $query->select(DB::raw(1))
                ->from('library_assign_user')
                ->whereRaw('libraries.id = library_assign_user.library_id');
        })
        ->get()
        ->sortBy('libraries.library_name');
        return $unassigned;
    }

    public static function getMyLibrary($id)
    {
        $library = DB::table('libraries')
            ->join('library_assign_user','libraries.id','=','library_assign_user.library_id')
            ->join('users', 'library_assign_user.user_id','=','users.id')
            ->where('users.id','=',$id);
        return $library;
    }

    public function getAssignedVolunteers($id)
    {
        $volunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$id)
            ->select(
                'library_volunteer_assignments.id as assignment_id',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.email',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id'
            )
            ->get();
        return $volunteers;
    }
}
