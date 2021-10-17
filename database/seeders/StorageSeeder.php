<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Storage;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::create([
            'shortname' => 'LAB-MM',
            'storagename' => 'Laboratorium MM',
            'organitation_id' => '1',
            'user_id' => '2',
        ]);

        Storage::create([
            'shortname' => 'LAB-TKJ',
            'storagename' => 'Laboratorium TKJ',
            'organitation_id' => '2',
            'user_id' => '4',
        ]);

    }
}
