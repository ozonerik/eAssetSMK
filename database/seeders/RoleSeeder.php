<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles
        $admin=Role::create(['name' => 'admin']);
        $gurumapel=Role::create(['name' => 'kabeng']);
        $user=Role::create(['name' => 'user']);

    }
}
