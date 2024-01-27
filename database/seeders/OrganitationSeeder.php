<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organitation;

class OrganitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organitation::create([
            'code' => '00',
            'shortname' => 'ADMIN',
            'name' => 'Admin',
        ]);

        Organitation::create([
                'code' => '01',
                'shortname' => 'mm',
                'name' => 'Multimedia',
            ]);
        
        Organitation::create([
                'code' => '02',
                'shortname' => 'tkj',
                'name' => 'Teknik Komputer dan Jaringan',
            ]);
    }
}
