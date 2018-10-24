<?php

use Illuminate\Database\Seeder;

class PositionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'DIRECCIÓN GENERAL EJECUTIVA', 'shortened' => 'DGE'],
            ['name' => 'HONORABLE DIRECTORIO', 'shortened' => ''],
            ['name' => 'UNIDAD DE AUDITORÍA INTERNA', 'shortened' => ''],
            ['name' => 'UNIDAD DE TRANSPARENCIA INSTITUCIONAL', 'shortened' => ''],
            ['name' => 'UNIDAD DE PLANIFICACIÓN ORGANIZACIÓN Y MÉTODOS', 'shortened' => ''],
            ['name' => 'UNIDAD DE GESTIÓN DOCUMENTAL Y ARCHIVO', 'shortened' => ''],
            ['name' => 'DIRECCIÓN DE ESTRATEGIAS SOCIALES E INVERSIONES', 'shortened' => ''],
            ['name' => 'UNIDAD DE INVERSIÓN EN PRÉSTAMO', 'shortened' => ''],
            ['name' => 'UNIDAD DE INVERSIÓN EN SERVICIOS, BIENES Y PATRIMONIO', 'shortened' => ''],
            ['name' => 'HOSTAL PARÍS', 'shortened' => ''],
            ['name' => 'DIRECCIÓN DE BENEFICIOS ECONÓMICOS', 'shortened' => ''],
            ['name' => 'UNIDAD DE OTOR. FONDO DE RET. POL. IND. CUOTA Y AUXILIO MORT.', 'shortened' => ''],
            ['name' => 'UNIDAD DE OTORGACIÓN DEL COMPLEMENTO ECONÓMICO', 'shortened' => ''],
            ['name' => 'DIRECCIÓN DE ASUNTOS ADMINISTRATIVOS', 'shortened' => ''],
            ['name' => 'UNIDAD FINANCIERA', 'shortened' => ''],
            ['name' => 'UNIDAD ADMINISTRATIVA', 'shortened' => ''],
            ['name' => 'UNIDAD DE RECURSOS HUMANOS', 'shortened' => ''],
            ['name' => 'UNIDAD DE SISTEMAS Y SOPORTE TÉCNICO', 'shortened' => ''],
            ['name' => 'DIRECCIÓN DE ASESORAMIENTO JURÍDICO ADMIN. Y DEF. INST.', 'shortened' => ''],
            ['name' => 'UNIDAD INTEGRAL ADMINISTRATIVA INSTITUCIONAL', 'shortened' => ''],
            ['name' => 'UNIDAD INTEGRAL DE DEFENSA Y REPRESENTACIÓN INSTITUC.', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL SANTA CRUZ', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL COCHABAMBA', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL ORURO', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL CHUQUISACA', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL POTOSI', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL TARIJA', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL BENI', 'shortened' => ''],
            ['name' => 'REPRESENTACIÓN DEPARTAMENTAL PANDO', 'shortened' => ''],

        ];
        foreach ($statuses as $status) {
            App\PositionGroup::create($status);
        }
    }
}
