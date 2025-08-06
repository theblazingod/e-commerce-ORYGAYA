<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    protected $roleRedirects = [
        'admin' => '/admin',
        'buyer' => '/buyer/dashboard',
    ];

    protected function shouldRedirect(Request $request, $redirect)
    {
        // Check if the current request path matches the redirect path
        return !$request->is($redirect) && !$request->is($redirect . '/*');
    }

    public function toResponse($request)
    {
        
        $user = Auth::user();

        foreach ($this->roleRedirects as $role => $redirect) {
            if ($user->hasRole($role)) {
                return $request->wantsJson()
                    ? new JsonResponse(['two_factor' => false], 200)
                    : ($this->shouldRedirect($request, $redirect)
                        ? redirect()->to($redirect)
                        : redirect()->intended($redirect));
            }
        }

        // Default redirection
        $redirect = '/';
        return $request->wantsJson()
            ? new JsonResponse(['two_factor' => false], 200)
            : ($this->shouldRedirect($request, $redirect)
                        ? redirect()->to($redirect)
                        : redirect()->intended($redirect));
    }
}
