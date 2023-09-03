<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $sToken = $_COOKIE[config('auth.token.key')] ?? '';
        $sDescryptedToken = '';
        if ($sToken) {
            $sDescryptedToken = Crypt::decryptString($sToken);
        }
        $request->headers->add([
            'Authorization' => 'Bearer ' . $sDescryptedToken
        ]);
        if (auth('sanctum')->user()) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
