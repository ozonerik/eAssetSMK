<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::create([
            'no' => '1',
            'qrcode' => '01.01.20.001.00001',
            'name' => 'Laptop',
            'description' => 'Laptop Dari Dana BOS',
            'purchase_date' => '2021-09-11',
            'purchase_price' => '0',
            'good_qty' => '15',
            'med_qty' => '0',
            'bad_qty' => '0',
            'lost_qty' => '0',
            'picture' => '',
            'qrpicture' => '',
            'budgeting_id' => '1',
            'fiscalyear_id' => '1',
            'itemtype_id' => '1',
            'storeroom_id' => '1',
            'organitation_id' => '2',
            'user_id' => '3',
        ]);
    }
}
