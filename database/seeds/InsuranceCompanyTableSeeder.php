<?php

use Illuminate\Database\Seeder;

class InsuranceCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Caja Nacional de Salud (C.N.S.)'],
            ['name' => 'Seguro Social Universitario (S.I.S.S.U.B.)'],
        ];
        foreach ($statuses as $status) {
            App\InsuranceCompany::create($status);
        }
    }
}
