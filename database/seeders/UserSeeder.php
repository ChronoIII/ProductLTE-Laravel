<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aAdmins = [
            [
                'name'  => 'admin',
                'username'  => 'admin',
                'email' => 'admin@email.com',
            ],
            [
                'name'  => 'test',
                'username' => 'test',
                'email' => 'test@gmail.com',
            ],
        ];

        foreach ($aAdmins as $iIndex => $oAdmin) {
            try {
                UserModel::factory()
                    ->name($oAdmin['name'])
                    ->username($oAdmin['username'])
                    ->email($oAdmin['email'])
                    ->create();
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
    }
}
