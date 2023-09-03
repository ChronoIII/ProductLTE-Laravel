<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class AuthService
{
    private $oUserRepository;

    public function __construct(UserRepository $oUserRepository) {
        $this->oUserRepository = $oUserRepository;
    }

    public function loginUser(array $aData) {
        $oUserData = $this->oUserRepository->getUserData([
            'username' => $aData['id'],
        ]);

        if ($oUserData !== null && Hash::check($aData['password'], $oUserData->password)) {
            $oUserData = $this->createSession($oUserData, $aData['remember']);
        }
        return $oUserData;
    }

    public function registerUser(array $oUser) {
        $oUser['password'] = Hash::make($oUser['password']);
        return $this->oUserRepository->saveUserData($oUser);
    }

    private function createSession($oUserData, $bRemember) {
        $aTokenAbilities = [];
        if ($bRemember) {
            array_push($aTokenAbilities, 'remember');
        }
        $oToken = $oUserData->createToken($oUserData->name . ' token', $aTokenAbilities);
        $sToken = Crypt::encryptString($oToken->plainTextToken);

        return [
            'user'  => $oUserData,
            'token' => $sToken,
        ];
    }
}
