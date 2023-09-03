<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository
{
    private $oUserModel;

    public function __construct(UserModel $oUserModel) {
        $this->oUserModel = $oUserModel;
    }

    public function getUserData(array $aFilter) {
        $oUserData = $this->oUserModel->where($aFilter);
        if (empty($oUserData)) {
            return null;
        }
        return $oUserData->first();
    }

    public function saveUserData(array $oUser) {
        $aFilter = [
            'name'  => $oUser['name'],
            'email' => $oUser['email'],
        ];
        return $this->oUserModel->updateOrCreate($aFilter, $oUser);
    }
}
