<?php

use Illuminate\Database\Seeder;

class ManagementEntityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'AFP FUTURO'],
            ['name' => 'AFP PREVISION'],
        ];
        foreach ($statuses as $status) {
            App\ManagementEntity::create($status);
        }
    }
}
