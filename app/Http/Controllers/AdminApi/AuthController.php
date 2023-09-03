<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Requests\LoginUserRequest;
use App\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    private $oAuthService;

    public function __construct(AuthService $oAuthService) {
        $this->oAuthService = $oAuthService;
    }

    public function loginUser(LoginUserRequest $oRequest) {
        $aData = $oRequest->validated();

        $oResponse = $this->oAuthService->loginUser($aData);

        if ($oResponse === null) {
            return response()->json([
                'message'   => 'Authentication failed',
                'data'      => null,
            ], 401);
        }

        $iTTL = $aData['remember'] ? config('auth.token.remember_ttl') : config('auth.token.ttl');
        return response()->json([
            'message'   => 'Success',
            'data'      => $oResponse,
        ], 200)->withCookie(cookie(config('auth.token.key'), $oResponse['token'], $iTTL));
    }

    public function registerUser(RegisterUserRequest $oRequest) {
        $aParams = $oRequest->validated();

        $oResponse = $this->oAuthService->registerUser($aParams);

        return response()->json([
            'message'   => 'Success',
            'data'      => $oResponse,
        ], 201);
    }

    public function logoutUser(Request $oRequest) {
        return response()
            ->json(['message' => true])
            ->withCookie(cookie(config('auth.token.key'), null, 0));
    }

    public function currentUser() {
        return response()->json([
            'user'  => auth('sanctum')->user()
        ], 200);
    }
}
