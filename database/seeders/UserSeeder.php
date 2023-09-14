<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = json_decode(file_get_contents('database/jsons/users.json'), true);

        foreach($values as $user){
            $user_model = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']), //quitar hash cuando ya no se usen los usuarios de prueba
                'hotel_id' => $user['hotel_id'],
                'role_id' => $user['role_id']
            ]);

            $role = Role::find($user['role_id']);
            $user_model->assignRole($role);
        }
    }
}
