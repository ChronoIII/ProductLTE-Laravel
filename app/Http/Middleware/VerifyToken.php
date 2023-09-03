<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerifyToken
{
    public function handle($request, $next) {
        $sToken = $_COOKIE[config('auth.token.key')] ?? '';
        $sDescryptedToken = '';
        if ($sToken) {
            $sDescryptedToken = Crypt::decryptString($sToken);
        }
        $request->headers->add([
            'Authorization' => 'Bearer ' . $sDescryptedToken,
        ]);

        if (auth('sanctum')->user()) {
            return $this->refreshCookieTimeout($sToken, $next($request));
        }
        abort(401, 'Unauthorized');
    }

    private function refreshCookieTimeout($sToken, $response) {
        $iTTL = auth('sanctum')->user()->tokenCan('remember') ? config('auth.token.remember_ttl') : config('auth.token.ttl');
        $oCookie = cookie(config('auth.token.key'), $sToken, $iTTL);
        return $response->withCookie($oCookie);
    }
}
