<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrador = Role::create(['name' => "Administrador"]);
        $sistemas = Role::create(['name' => "Sistemas"]);
        $nil = Role::create(['name' => "AAA"]);

        // habitaciones
        Permission::create(['name' => 'rooms.get']);
        Permission::create(['name' => 'rooms.edit']);
        Permission::create(['name' => 'rooms.add']);
        Permission::create(['name' => 'rooms.delete']);

        $administrador->givePermissionTo([
            'rooms.get',
            'rooms.edit',
            'rooms.add',
            'rooms.delete'
        ]);

        $sistemas->givePermissionTo([
            'rooms.get'
        ]);

        //Asignando permisos
        $users = User::all();
        foreach ($users as $user){
            if($user->role_id!=null)
                $user->assignRole($user->role_id);
        }
    }
}
