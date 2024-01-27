<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Storeroom;

class StoreroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storeroom::create([
            'shortname' => 'LAB-MM',
            'roomname' => 'Laboratorium MM',
            'organitation_id' => '2',
            'user_id' => '2',
        ]);

        Storeroom::create([
            'shortname' => 'LAB-TKJ',
            'roomname' => 'Laboratorium TKJ',
            'organitation_id' => '3',
            'user_id' => '4',
        ]);

    }
}
