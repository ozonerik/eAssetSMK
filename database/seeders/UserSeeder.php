<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create(
        [
            'name' => 'Admin',
            'email' => 'admin@test.id',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');
        $admin->givePermissionTo(['create.*','read.*', 'update.*','delete.*']);
        //$admin->givePermissionTo(Permission::all());

        $user = User::create(
        [
            'name' => 'User',
            'email' => 'user@test.id',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('user');
        
        $gurumapel = User::create(
            [
                'name' => 'Guru Mapel',
                'email' => 'gurumapel@test.id',
                'password' => bcrypt('12345678'),
            ]);
        $gurumapel->assignRole('gurumapel');
    }
}
