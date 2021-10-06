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
            'organitation_id' => '1',
        ]);
        $admin->assignRole('admin');
        $admin->givePermissionTo(['create.*','read.*', 'update.*','delete.*']);
        //$admin->givePermissionTo(Permission::all());

        $user = User::create(
        [
            'name' => 'User',
            'email' => 'user@test.id',
            'password' => bcrypt('12345678'),
            'organitation_id' => '2',
        ]);
        $user->assignRole('user');
        
        $kabeng = User::create(
            [
                'name' => 'Kepala Bengkel',
                'email' => 'kabeng@test.id',
                'password' => bcrypt('12345678'),
            ]);
        $kabeng->assignRole('kabeng');

        $toolman = User::create(
            [
                'name' => 'Toolman',
                'email' => 'toolman@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '1',
            ]);
        $toolman->assignRole('toolman');

    }
}
