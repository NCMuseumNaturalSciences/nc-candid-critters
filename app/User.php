<?php

namespace App;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Auth;
class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->fname . ' ' . $this->lname;
    }

    public static function getMyLibrary() {
        $userid = Auth::user()->getId();
        $library = DB::table('libraries')
            ->join('library_assign_user','libraries.id','=','library_assign_user.library_id')
            ->join('users','library_assign_user.user_id','=','users.id')
            ->where('users.id','=',$userid)
            ->first();
        return $library;
    }


    public static function getUnassigned(){
        $users = User::hasRole('library');
        $unassigned = User::whereNotExists( function ($query) use ($users)  {
            $query->select(DB::raw(1))
                ->from('library_assign_user')
                ->whereRaw('users.id = library_assign_user.user_id');
            })
        ->get()
            ->sortBy('users.lname','users.fname');
        return $unassigned;
    }


}
