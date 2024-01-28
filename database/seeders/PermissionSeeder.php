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
        Permission::create(['name' => 'create.sumber_anggaran']);
        Permission::create(['name' => 'read.sumber_anggaran']);
        Permission::create(['name' => 'update.sumber_anggaran']);
        Permission::create(['name' => 'delete.sumber_anggaran']);
        // create permissions organisasi
        Permission::create(['name' => 'create.organisasi']);
        Permission::create(['name' => 'read.organisasi']);
        Permission::create(['name' => 'update.organisasi']);
        Permission::create(['name' => 'delete.organisasi']);
        // create permissions fiscalyear
        Permission::create(['name' => 'create.tahun_anggaran']);
        Permission::create(['name' => 'read.tahun_anggaran']);
        Permission::create(['name' => 'update.tahun_anggaran']);
        Permission::create(['name' => 'delete.tahun_anggaran']);
        // create permissions itemtype
        Permission::create(['name' => 'create.jenis_barang']);
        Permission::create(['name' => 'read.jenis_barang']);
        Permission::create(['name' => 'update.jenis_barang']);
        Permission::create(['name' => 'delete.jenis_barang']);
        // create permissions storages
        Permission::create(['name' => 'create.penyimpanan']);
        Permission::create(['name' => 'read.penyimpanan']);
        Permission::create(['name' => 'update.penyimpanan']);
        Permission::create(['name' => 'delete.penyimpanan']);
        // create permissions storages
        Permission::create(['name' => 'create.inventaris']);
        Permission::create(['name' => 'read.inventaris']);
        Permission::create(['name' => 'update.inventaris']);
        Permission::create(['name' => 'delete.inventaris']);

    }
}
