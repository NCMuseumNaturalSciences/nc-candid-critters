<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\LibraryAssignUser;
use App\Library;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();
        $users = User::all();
        return view('admin.users.index', compact('user'))->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
            	$user = Auth::user();
        return view('admin.users.create', ['user' => $user, 'roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname'=>'required|max:120',
            'lname'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('email', 'fname', 'lname', 'password'));

        $roles = $request['roles'];

        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('flash_message',
                'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('admin/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$user = User::whereId($id)->firstOrFail();
        $user->fname = $request->get('fname');
        $user->lname = $request->get('lname');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != "") {
            $user->password = Hash::make($password);
        }
        $user->save();
        $roles = $request['roles'];
 		if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }
        Session::flash('flash_message', 'User updated!');
		return redirect()->action('Admin\UsersController@show', ['id' => $id]);
/*		
        $user = User::findOrFail($id);
        $this->validate($request, [
            'fname'=>'required|max:120',
            'lname'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]);

        $input = $request->only(['fname','lname','email', 'password']);
        $roles = $request['roles'];
        $user->fill($input)->save();

        if (isset($roles)) {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }
        return redirect()->route('admin.users.index')
            ->with('flash_message',
                'User successfully edited.');
                */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('flash_message',
                'User successfully deleted.');
    }


    /**
     * Assign Library
     */
    public function assignLibrary()
    {
        $libraries = Library::getUnassigned();
        $users = User::getUnassigned();
        return view('libraries.assign.create', compact('libraries','users'));
    }

    public function storeAssignment(Request $request)
    {
        $assignment = LibraryAssignUser::create($request->all());
        Session::flash('flash_message', 'User Assigned to Library!');
        return redirect()->action('Admin\LibrariesController@show', ['id' => $assignment->library_id]);

    }
    public function editAssignment($id)
    {
        $libraries = Library::getUnassigned();
        $users = User::getUnassigned();
        $assignment = LibraryAssignUser::findOrFail($id);
        return view('libraries.assign.edit', compact('libraries','users','assignment'));
    }
    public function updateAssignment(Request $request, $id)
    {
        $assignment = LibraryAssignUser::findOrFail($id);
        $assignment->update($request->all());
        Session::flash('flash_message', 'Library Assignment updated!');
        return redirect()->action('Admin\LibrariesController@show', ['id' => $assignment->library_id]);
    }

    public function destroyAssignment($id)
    {
        $assignment = LibraryAssignUser::findOrFail($id);
        $assignment->delete();
    }
}
