<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budgeting;

class BudgetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Budgeting::create([
            'code' => '01',
            'name' => 'Dana BOS',
            'organitation_id' => '1',
        ]);

        Budgeting::create([
            'code' => '02',
            'name' => 'Dana Kas',
            'organitation_id' => '1',
        ]);
        Budgeting::create([
            'code' => '01',
            'name' => 'Dana BOS',
            'organitation_id' => '2',
        ]);

        Budgeting::create([
            'code' => '02',
            'name' => 'Dana Kas',
            'organitation_id' => '2',
        ]);
    }
}
