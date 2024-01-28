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
        
        $kabeng = User::create(
            [
                'name' => 'Kabeng MM',
                'email' => 'kabengmm@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '2',
            ]);
        $kabeng->assignRole('kabeng');
        $kabeng->givePermissionTo(['create.*','read.*', 'update.*','delete.*']);

        $toolman = User::create(
            [
                'name' => 'Toolman MM',
                'email' => 'toolmanmm@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '2',
            ]);
        $toolman->assignRole('toolman');
        $toolman->givePermissionTo(['create.inventaris','read.inventaris', 'update.inventaris','delete.inventaris']);

        $kabeng = User::create(
            [
                'name' => 'Kabeng TKJ',
                'email' => 'kabengtkj@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '3',
            ]);
        $kabeng->assignRole('kabeng');
        $kabeng->givePermissionTo(['create.*','read.*', 'update.*','delete.*']);

        $toolman = User::create(
            [
                'name' => 'Toolman TKJ',
                'email' => 'toolmantkj@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '3',
            ]);
        $toolman->assignRole('toolman');
        $toolman->givePermissionTo(['create.inventaris','read.inventaris', 'update.inventaris','delete.inventaris']);

        $usermm = User::create(
            [
                'name' => 'User MM',
                'email' => 'usermm@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '2',
            ]);
        $usermm->assignRole('user');

        $usertkj = User::create(
            [
                'name' => 'User TKJ',
                'email' => 'usertkj@test.id',
                'password' => bcrypt('12345678'),
                'organitation_id' => '3',
            ]);
        $usertkj->assignRole('user');

    }
}
