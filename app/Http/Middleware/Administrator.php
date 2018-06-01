<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;

class Administrator
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
        $role = new Role;
        
        if (auth()->user()->isAdmin($role)) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
