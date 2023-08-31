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

       Permission::create(['name' => 'rooms.get']);
       Permission::create(['name' => 'rooms.create']);
       Permission::create(['name' => 'rooms.edit']);
       Permission::create(['name' => 'rooms.delete']);

       Permission::create(['name' => 'roles.get']);
       Permission::create(['name' => 'roles.create']);
       Permission::create(['name' => 'roles.edit']);
       Permission::create(['name' => 'roles.delete']);

       Permission::create(['name' => 'settings.get']);
       Permission::create(['name' => 'settings.edit']);
    //    Permission::create(['name' => 'settings.create']);
    //    Permission::create(['name' => 'settings.delete']);

      Permission::create(['name' => 'contacts.get']);
      Permission::create(['name' => 'contacts.create']);
      Permission::create(['name' => 'contacts.edit']);
      Permission::create(['name' => 'contacts.delete']);
       
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
        'hotels.edit',
        'hotels.delete',

        'rooms.get',
        'rooms.create',
        'rooms.edit',
        'rooms.delete',

        'roles.get',
        'roles.create',
        'roles.edit',
        'roles.delete',

        'settings.get',
        'settings.edit',
        //   'settings.create',
      //   'settings.delete',

         'contacts.get',
         'contacts.create',
         'contacts.edit',
         'contacts.delete',


   ]);
       $administrador->givePermissionTo(['users.get']);
       
    }
}
