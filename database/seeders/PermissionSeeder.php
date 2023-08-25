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
       
       Permission::create(['name' => 'clients.get']);
       Permission::create(['name' => 'clients.create']);
       Permission::create(['name' => 'clients.edit']);
       Permission::create(['name' => 'clients.delete']);

       Permission::create(['name' => 'hotels.get']);
       Permission::create(['name' => 'hotels.create']);
       Permission::create(['name' => 'hotels.edit']);
       Permission::create(['name' => 'hotels.delete']);
       
       $sistemas->givePermissionTo([
        'users.get',
        'users.create',
        'users.edit',
        'users.delete',

        'clients.get',
        'clients.create',
        'clients.edit',
        'clients.delete',

        'hotels.get',
        'hotels.create',
        'hotels.get',
        'hotels.edit',
        'hotels.delete'
    ]);
       $administrador->givePermissionTo(['users.get']);
       
    }
}
