<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fiscalyear;

class FiscalyearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fiscalyear::create([
            'code' => '20',
            'year' => '2020',
            'organitation_id' => '1',
            'user_id' => '2',
        ]);

        Fiscalyear::create([
            'code' => '21',
            'year' => '2021',
            'organitation_id' => '1',
            'user_id' => '3',
        ]);

        Fiscalyear::create([
            'code' => '20',
            'year' => '2020',
            'organitation_id' => '2',
            'user_id' => '4',
        ]);

        Fiscalyear::create([
            'code' => '21',
            'year' => '2021',
            'organitation_id' => '2',
            'user_id' => '5',
        ]);
    }
}
