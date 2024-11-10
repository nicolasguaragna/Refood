<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;

class AssignRolesToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRoles = [
            'micag@example.com' => ['user'],
            'tatianab@example.com' => ['admin', 'user'],
            'briang@example.com' => ['user'],
            'nico_guaragna@hotmail.com' => ['admin', 'user'],
        ];

        foreach ($userRoles as $email => $roles) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $roleIds = Rol::whereIn('name', $roles)->pluck('id');
                $user->roles()->syncWithoutDetaching($roleIds);
            }
        }
    }
}
