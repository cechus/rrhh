<?php

use Illuminate\Database\Seeder;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
                'month_id'             => 4,
                'year'                 => 2018,
                'name'                 => 'mese de ...',
                'discount_old'         => 10,
                'discount_common_risk' => 1.71,
                'discount_commission'  => 0.5,
                'discount_solidary'    => 0.5,
                'discount_national'    => 0,
                'discount_rc_iva'      => 13,
                'discount_faults'      => 0,
            ];

        App\Procedure::create($statuses);
    }
}
