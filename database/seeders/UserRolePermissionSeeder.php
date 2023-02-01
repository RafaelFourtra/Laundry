<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'name' => 'admin'
            ], $default_user_value));
    
            $petugas = User::create(array_merge([
                'email' => 'petugas@gmail.com',
                'name' => 'petugas'
            ], $default_user_value));
    
            $owner = User::create(array_merge([
                'email' => 'owner@gmail.com',
                'name' => 'owner'
            ], $default_user_value));

            $AdminRole = Role::create(['name' => 'admin']);
            $PetugasRole = Role::create(['name' => 'petugas']);
            $OwnerRole = Role::create(['name' => 'owner']);

            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
            Permission::create((['name' => 'read konfigurasi']));

            $AdminRole->givePermissionTo('read role');
            $AdminRole->givePermissionTo('create role');
            $AdminRole->givePermissionTo('update role');
            $AdminRole->givePermissionTo(['delete role' , 'read konfigurasi']);

            

            $admin->assignRole('admin');
            $petugas->assignRole('petugas');
            $owner->assignRole('owner');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        
    }
}
