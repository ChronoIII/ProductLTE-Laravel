<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\UserFactory;

class UserModel extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 't_users';

    protected $primaryKey = 'user_id';

    protected $guarded = [];

    protected $hidden = [];

    protected function newFactory() {
        return new UserFactory();
    }
}
