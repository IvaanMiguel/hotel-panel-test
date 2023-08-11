<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $sistemas = Role::create(['name' => 'Sistemas']);
       $administrador = Role::create(['name' => 'Administrador']);

       Permission::create(['name' => 'users.get']);
       Permission::create(['name' => 'users.create']);
       Permission::create(['name' => 'users.edit']);
       Permission::create(['name' => 'users.delete']);

       
       $sistemas->givePermissionTo([
        'users.get',
        'users.create',
        'users.edit',
        'users.delete'
    ]);
       $administrador->givePermissionTo(['users.get']);
       
    }
}
