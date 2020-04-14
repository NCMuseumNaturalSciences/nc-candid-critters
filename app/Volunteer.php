<?php

namespace App;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table = 'volunteers';
    protected $guarded = ['id'];

    public function signup()
    {
        return $this->belongsTo('App\Signup');
    }

    public function assignments()
    {
        return $this->hasMany('App\LibraryVolunteerAssignment', 'volunteer_id');
    }

    public function deployments()
    {
        return $this->hasMany('App\Deployment');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function users()
    {
        return $this->hasOne('App\User');
    }

    public static function getMyAssignedVolunteers()
    {
        $user = Auth::user();
        $library = Library::getMyLibrary($user->id)->first();
        $volunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers', 'library_volunteer_assignments.volunteer_id', '=', 'volunteers.id')
            ->join('libraries', 'library_volunteer_assignments.library_id', '=', 'libraries.id')
            ->where('libraries.id', '=', $library->id)
            ->select('library_volunteer_assignments.id as assignment_id', 'volunteers.first_name', 'volunteers.last_name', 'volunteers.email', 'library_volunteer_assignments.volunteer_id', 'library_volunteer_assignments.library_id');
        return $volunteers->get();
    }
    public static function getLibraryAssignments($library_id)
    {
        $volunteers = DB::table('volunteers')
            ->join('library_volunteer_assignments', 'volunteers.id', '=', 'library_volunteer_assignments.volunteer_id')
            ->join('libraries', 'library_volunteer_assignments.library_id', '=', 'libraries.id')
            ->where('libraries.id', '=', $library_id)
            ->select('volunteers.id',
                'library_volunteer_assignments.id as assignment_id',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.email',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id');
        return $volunteers->get();
    }

}
