<?php

use Illuminate\Database\Seeder;

class MonthsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Enero', 'shortened' => 'ENE'],
            ['name' => 'Febrero', 'shortened' => 'FEB'],
            ['name' => 'Marzo', 'shortened' => 'MAR'],
            ['name' => 'Abril', 'shortened' => 'ABR'],
            ['name' => 'Mayo', 'shortened' => 'MAY'],
            ['name' => 'Junio', 'shortened' => 'JUN'],
            ['name' => 'Julio', 'shortened' => 'JUL'],
            ['name' => 'Agosto', 'shortened' => 'AGO'],
            ['name' => 'Septiembre', 'shortened' => 'SEP'],
            ['name' => 'Octubre', 'shortened' => 'OCT'],
            ['name' => 'Noviembre', 'shortened' => 'NOV'],
            ['name' => 'Diciembre', 'shortened' => 'DIC'],
        ];
        foreach ($statuses as $status) {
            App\Month::create($status);
        }
    }
}
