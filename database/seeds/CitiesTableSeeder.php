<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'BENI', 'shortened' => 'BN'],
            ['name' => 'CHUQUISACA', 'shortened' => 'CH'],
            ['name' => 'COCHABAMBA', 'shortened' => 'CB'],
            ['name' => 'LA PAZ', 'shortened' => 'LP'],
            ['name' => 'ORURO', 'shortened' => 'OR'],
            ['name' => 'PANDO', 'shortened' => 'PD'],
            ['name' => 'POTOSÍ', 'shortened' => 'PT'],
            ['name' => 'SANTA CRUZ', 'shortened' => 'SC'],
            ['name' => 'TARIJA', 'shortened' => 'TJ'],
        ];
        foreach ($statuses as $status) {
            App\City::create($status);
        }
    }
}
