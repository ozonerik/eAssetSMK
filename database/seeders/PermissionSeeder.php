<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions CRUD
        Permission::create(['name' => 'create.*']);
        Permission::create(['name' => 'read.*']);
        Permission::create(['name' => 'update.*']);
        Permission::create(['name' => 'delete.*']);

    }
}
