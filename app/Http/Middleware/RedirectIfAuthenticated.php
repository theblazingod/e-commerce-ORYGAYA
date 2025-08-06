<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    protected $roleRedirects = [
        'admin' => '/admin',

        'buyer' => '/buyer/dashboard',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                if ($user->role === 'admin') {
                    return redirect('/admin');
                }

                foreach ($this->roleRedirects as $role => $redirect) {
                    if ($user->role === $role) {
                        return redirect($redirect);
                    }
                }
                // If user has a role not in $roleRedirects, redirect to /{role}
                $userRole = $user->role;
                if ($userRole) {
                    return redirect('/' . $userRole);
                }
                // If user has no roles, redirect to default home
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
