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
        // create permissions budget
        Permission::create(['name' => 'create.budgeting']);
        Permission::create(['name' => 'read.budgeting']);
        Permission::create(['name' => 'update.budgeting']);
        Permission::create(['name' => 'delete.budgeting']);
        // create permissions organisasi
        Permission::create(['name' => 'create.organitation']);
        Permission::create(['name' => 'read.organitation']);
        Permission::create(['name' => 'update.organitation']);
        Permission::create(['name' => 'delete.organitation']);

    }
}
