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
       Permission::create(['name' => 'clients.add']);
       Permission::create(['name' => 'clients.edit']);
       Permission::create(['name' => 'clients.delete']);
       
       $sistemas->givePermissionTo([
        'users.get',
        'users.create',
        'users.edit',
        'users.delete',

        'clients.get',
        'clients.add',
        'clients.edit',
        'clients.delete'
    ]);
       $administrador->givePermissionTo(['users.get']);
       
    }
}
