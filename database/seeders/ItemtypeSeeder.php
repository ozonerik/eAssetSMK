<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Itemtype;

class ItemtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Itemtype::create([
            'code' => '001',
            'shortname' => 'COMP',
            'typename' => 'Peralatan Komputer',
            'organitation_id' => '2',
            'user_id' => '2',
        ]);

        Itemtype::create([
            'code' => '002',
            'shortname' => 'CAM',
            'typename' => 'Peralatan Kamera',
            'organitation_id' => '2',
            'user_id' => '3',
        ]);

        Itemtype::create([
            'code' => '001',
            'shortname' => 'NET',
            'typename' => 'Peralatan Jaringan',
            'organitation_id' => '3',
            'user_id' => '4',
        ]);

        Itemtype::create([
            'code' => '002',
            'shortname' => 'BOOK',
            'typename' => 'Buku Sumber Ajar',
            'organitation_id' => '3',
            'user_id' => '5',
        ]);

    }
}
