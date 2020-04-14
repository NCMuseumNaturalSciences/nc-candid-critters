<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Contracts\Auth\Guard;

class LibrarianAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect('/login');
        }
        else {
            $user = Auth::user();
            if ($user->hasRole('librarian')) {
                return $next($request);
            }
            else {
                return response('Unauthorized.', 401);
            }
        }
    }
}
