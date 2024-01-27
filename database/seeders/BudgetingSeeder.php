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
            'name' => 'Dana BOS MM',
            'organitation_id' => '2',
            'user_id' => '2',
        ]);

        Budgeting::create([
            'code' => '02',
            'name' => 'Dana Kas MM',
            'organitation_id' => '2',
            'user_id' => '3',
        ]);
        Budgeting::create([
            'code' => '01',
            'name' => 'Dana BOS TKJ',
            'organitation_id' => '3',
            'user_id' => '4',
        ]);

        Budgeting::create([
            'code' => '02',
            'name' => 'Dana Kas TKJ',
            'organitation_id' => '3',
            'user_id' => '5',
        ]);
    }
}
