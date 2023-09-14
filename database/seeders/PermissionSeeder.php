<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\error;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $sistemas = Role::create(['name' => 'Sistemas']);
       $user = Role::create(['name' => 'User']);
       $administrador = Role::create(['name' => 'Administrador']);

       $data = json_decode(file_get_contents('database/jsons/permissions.json'), true);

       foreach($data as $item){

         $permission = Permission::create([
            'name' => $item['name'],
            'modulo' => $item['module'],
            'description' => $item['description'],
         ]);

         foreach($item['roles'] as $role){
            $permission->assignRole($role);
         }

         foreach(User::get() as $user){
            $user->assignRole($user->role_id);
         }
       }
 } 
}
