<?php

use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
                // DIRECCIÓN GENERAL EJECUTIVA
            ['name' => 'Director General Ejecutivo', 'charge_id' => 1, 'position_group_id' => 1, 'item' => 1],
            ['name' => 'Secretaria de Dirección', 'charge_id' => 10, 'position_group_id' => 1, 'item' => 2],
            ['name' => 'Asistente de Dirección', 'charge_id' => 11, 'position_group_id' => 1, 'item' => 3],
            ['name' => 'Asistente y Mensajero', 'charge_id' => 11, 'position_group_id' => 1, 'item' => 4],
                // HONORABLE DIRECTORIO
            ['name' => 'Asesor Jurídico de Directorio', 'charge_id' => 6, 'position_group_id' => 2, 'item' => 5],
            ['name' => 'Asesor Financiero de Directorio', 'charge_id' => 6, 'position_group_id' => 2, 'item' => 6],
            ['name' => 'Secretaria de Honorable Directorio', 'charge_id' => 10, 'position_group_id' => 2, 'item' => 7],
                // UNIDAD DE AUDITORÍA INTERNA
            ['name' => 'Jefe de Unidad de Auditoria Interna', 'charge_id' => 3, 'position_group_id' => 3, 'item' => 8],
            ['name' => 'Auditor Interno I', 'charge_id' => 7, 'position_group_id' => 3, 'item' => 9],
            ['name' => 'Auditor Interno II', 'charge_id' => 7, 'position_group_id' => 3, 'item' => 10],
                // UNIDAD DE TRANSPARENCIA INSTITUCIONAL
            ['name' => 'Jefe de la Unidad de Transparencia Institucional', 'charge_id' => 4, 'position_group_id' => 4, 'item' => 11],
                // UNIDAD DE PLANIFICACIÓN ORGANIZACIÓN Y MÉTODOS
            ['name' => 'Jefe de la Unidad de Planificación, Organización y Métodos', 'charge_id' => 4, 'position_group_id' => 5, 'item' => 12],
                // UNIDAD DE GESTIÓN DOCUMENTAL Y ARCHIVO
            ['name' => 'Encargado de la Unidad de Gestión Documental y Archivo', 'charge_id' => 7, 'position_group_id' => 6, 'item' => 13],
            ['name' => 'Asistente de Registro y Despacho de Correspondencia', 'charge_id' => 13, 'position_group_id' => 6, 'item' => 14],
                // DIRECCIÓN DE ESTRATEGIAS SOCIALES E INVERSIONES
            ['name' => 'Director de Estrategias Sociales e Inversiones', 'charge_id' => 2, 'position_group_id' => 7, 'item' => 15],
            ['name' => 'Secretaria de Dirección', 'charge_id' => 10, 'position_group_id' => 7, 'item' => 16],
                // UNIDAD DE INVERSIÓN EN PRÉSTAMO
            ['name' => 'Jefe de Unidad de Inversión de Prestamos', 'charge_id' => 3, 'position_group_id' => 8, 'item' => 17],
            ['name' => 'Analista Legal Prestamos', 'charge_id' => 7, 'position_group_id' => 8, 'item' => 18],
            ['name' => 'Encargado de Calificación de Prestamos', 'charge_id' => 10, 'position_group_id' => 8, 'item' => 19],
            ['name' => 'Técnico de Atención al Afiliado I', 'charge_id' => 10, 'position_group_id' => 8, 'item' => 20],
            ['name' => 'Técnico de Atención al Afiliado II', 'charge_id' => 10, 'position_group_id' => 8, 'item' => 21],
            ['name' => 'Técnico de Atención al Afiliado III', 'charge_id' => 10, 'position_group_id' => 8, 'item' => 22],
            ['name' => 'Encargado de Registro, Control y Recuperación de Prestamos', 'charge_id' => 5, 'position_group_id' => 8, 'item' => 23],
            ['name' => 'Técnico de Recuperación y Cobranzas', 'charge_id' => 10, 'position_group_id' => 8, 'item' => 24],
                // UNIDAD DE INVERSIÓN EN SERVICIOS, BIENES Y PATRIMONIO
            ['name' => 'Jefe de Unidad de Inversión en Servicios, Bienes y Patrimonio', 'charge_id' => 4, 'position_group_id' => 9, 'item' => 25],
            ['name' => 'Encargado de Procesos Técnicos de Patrimonio y Bienes', 'charge_id' => 5, 'position_group_id' => 9, 'item' => 26],
            ['name' => 'Técnico de Conservación, Patrimonio y Bienes', 'charge_id' => 10, 'position_group_id' => 9, 'item' => 27],
            ['name' => 'Asistente de Conservación, Patrimonio y Bienes', 'charge_id' => 12, 'position_group_id' => 9, 'item' => 28],
                // HOSTAL PARÍS
            ['name' => 'Profesional Administrativo de Hostal Paris', 'charge_id' => 9, 'position_group_id' => 10, 'item' => 29],
            ['name' => 'Asistente de Recepción Diurna I', 'charge_id' => 10, 'position_group_id' => 10, 'item' => 30],
            ['name' => 'Asistente de Recepción Diurna II', 'charge_id' => 10, 'position_group_id' => 10, 'item' => 31],
            ['name' => 'Asistente de Recepción Nocturno', 'charge_id' => 13, 'position_group_id' => 10, 'item' => 32],
            ['name' => 'Asistente Turnante', 'charge_id' => 13, 'position_group_id' => 10, 'item' => 33],
            ['name' => 'Asistente Camarero', 'charge_id' => 13, 'position_group_id' => 10, 'item' => 34],
                // DIRECCIÓN DE BENEFICIOS ECONÓMICOS
            ['name' => 'Director de Beneficios Económicos', 'charge_id' => 2, 'position_group_id' => 11, 'item' => 35],
            ['name' => 'Secretaria de Dirección', 'charge_id' => 10, 'position_group_id' => 11, 'item' => 36],
            ['name' => 'Profesional de Archivo y Gestión Documental de Beneficios Económicos', 'charge_id' => 10, 'position_group_id' => 11, 'item' => 37],
            ['name' => 'Profesional de Trabajo Social', 'charge_id' => 9, 'position_group_id' => 11, 'item' => 38],
                // UNIDAD DE OTOR. FONDO DE RET. POL. IND. CUOTA Y AUXILIO MORT.
            ['name' => 'Jefe de Unidad de Otorgación de Fondo de Retiro Policial Individual Cuota y Auxilio Mortuorio', 'charge_id' => 3, 'position_group_id' => 12, 'item' => 39],
            ['name' => 'Analista Legal Fondo de Retiro Cuota y Auxilio Mortuorio', 'charge_id' => 7, 'position_group_id' => 12, 'item' => 40],
            ['name' => 'Técnico de Atención al Afiliado Fondo de Retiro', 'charge_id' => 10, 'position_group_id' => 12, 'item' => 41],
            ['name' => 'Encargado de Calificación de Fondo de Retiro Cuota y Auxilio Mortuorio', 'charge_id' => 7, 'position_group_id' => 12, 'item' => 42],
            ['name' => 'Técnico de Procesos de Calificación de Fondo de Retiro, Cuota y Auxilio Mortuorio', 'charge_id' => 10, 'position_group_id' => 12, 'item' => 43],
            ['name' => 'Encargado de Cuentas Individuales', 'charge_id' => 7, 'position_group_id' => 12, 'item' => 44],
            ['name' => 'Técnico de Control de Aportes', 'charge_id' => 10, 'position_group_id' => 12, 'item' => 45],
                // UNIDAD DE OTORGACIÓN DEL COMPLEMENTO ECONÓMICO
            ['name' => 'Jefe de Unidad de Otorgación del Complemento Económico', 'charge_id' => 3, 'position_group_id' => 13, 'item' => 46],
            ['name' => 'Analista Legal del Complemento Económico', 'charge_id' => 7, 'position_group_id' => 13, 'item' => 47],
            ['name' => 'Técnico de Atención al Afiliado Complemento Económico', 'charge_id' => 9, 'position_group_id' => 13, 'item' => 48],
            ['name' => 'Encargado de Calificación Complemento Económico', 'charge_id' => 9, 'position_group_id' => 13, 'item' => 49],
            ['name' => 'Técnico de Verificación y Validación Documental', 'charge_id' => 10, 'position_group_id' => 13, 'item' => 50],
            ['name' => 'Técnico de Procesos de Calificación Complemento Económico', 'charge_id' => 10, 'position_group_id' => 13, 'item' => 51],
            ['name' => 'Encargado de Organización y Logística', 'charge_id' => 10, 'position_group_id' => 13, 'item' => 52],
                // DIRECCIÓN DE ASUNTOS ADMINISTRATIVOS
            ['name' => 'Director de Asuntos Administrativos', 'charge_id' => 2, 'position_group_id' => 14, 'item' => 53],
            ['name' => 'Secretaria de Dirección', 'charge_id' => 10, 'position_group_id' => 14, 'item' => 54],
                // UNIDAD FINANCIERA
            ['name' => 'Jefe de Unidad Financiera', 'charge_id' => 3, 'position_group_id' => 15, 'item' => 55],
            ['name' => 'Responsable de Contabilidad Integrada', 'charge_id' => 5, 'position_group_id' => 15, 'item' => 56],
            ['name' => 'Analista de Sistemas Contable 1', 'charge_id' => 7, 'position_group_id' => 15, 'item' => 57],
            ['name' => 'Analista de Procesos de Información Contable', 'charge_id' => 7, 'position_group_id' => 15, 'item' => 58],
            ['name' => 'Técnico de Archivo y Manejo de Documentos Contables', 'charge_id' => 11, 'position_group_id' => 15, 'item' => 59],
            ['name' => 'Analista Contable de Fondos en Avance', 'charge_id' => 7, 'position_group_id' => 15, 'item' => 60],
            ['name' => 'Analista Contable de Inversiones', 'charge_id' => 7, 'position_group_id' => 15, 'item' => 61],
            ['name' => 'Responsable de Tesorería', 'charge_id' => 5, 'position_group_id' => 15, 'item' => 62],
            ['name' => 'Analista de Ingresos', 'charge_id' => 7, 'position_group_id' => 15, 'item' => 63],
            ['name' => 'Técnico de Recepción de Aportes y Caja General', 'charge_id' => 10, 'position_group_id' => 15, 'item' => 64],
            ['name' => 'Responsable de Programación y Ejecución Presupuestaria', 'charge_id' => 5, 'position_group_id' => 15, 'item' => 65],
            ['name' => 'Técnico de Procesamiento y Registro Presupuestario', 'charge_id' => 10, 'position_group_id' => 15, 'item' => 66],
                // UNIDAD ADMINISTRATIVA
            ['name' => 'Jefe de la Unidad Administrativa', 'charge_id' => 3, 'position_group_id' => 16, 'item' => 67],
            ['name' => 'Analista de Contratación y Adquisiciones', 'charge_id' => 7, 'position_group_id' => 16, 'item' => 68],
            ['name' => 'Profesional en Servicios Generales y Trámites Administrativos', 'charge_id' => 7, 'position_group_id' => 16, 'item' => 69],
            ['name' => 'Analista en Activos Fijos y Almacenes', 'charge_id' => 7, 'position_group_id' => 16, 'item' => 70],
                // UNIDAD DE RECURSOS HUMANOS
            ['name' => 'Jefe de la unidad de Recursos Humanos', 'charge_id' => 4, 'position_group_id' => 17, 'item' => 71],
            ['name' => 'Técnico en Recursos Humanos', 'charge_id' => 10, 'position_group_id' => 17, 'item' => 72],
                // UNIDAD DE SISTEMAS Y SOPORTE TÉCNICO
            ['name' => 'Jefe de la Unidad de Sistemas y Soportes Físico', 'charge_id' => 4, 'position_group_id' => 18, 'item' => 73],
            ['name' => 'Analista de Desarrollo y Mantenimiento de Software', 'charge_id' => 7, 'position_group_id' => 18, 'item' => 74],
            ['name' => 'Profesional Soporte Técnico', 'charge_id' => 7, 'position_group_id' => 18, 'item' => 75],
            ['name' => 'Analista en Programación de Sistemas', 'charge_id' => 7, 'position_group_id' => 18, 'item' => 76],
                // DIRECCIÓN DE ASESORAMIENTO JURÍDICO ADMIN. Y DEF. INST.
            ['name' => 'Director de Asesoramiento Jurídico, Administrativo y Defensa Institucional', 'charge_id' => 2, 'position_group_id' => 19, 'item' => 77],
            ['name' => 'Secretaria de Dirección', 'charge_id' => 10, 'position_group_id' => 19, 'item' => 78],
                // UNIDAD INTEGRAL ADMINISTRATIVA INSTITUCIONAL
            ['name' => 'Jefe de la Unidad Integral Administrativa Institucional', 'charge_id' => 4, 'position_group_id' => 20, 'item' => 79],
            ['name' => 'Analista Jurídico Administrativo', 'charge_id' => 7, 'position_group_id' => 20, 'item' => 80],
            ['name' => 'Analista de Procesos Administrativos y Contratos', 'charge_id' => 9, 'position_group_id' => 20, 'item' => 81],
                // UNIDAD INTEGRAL DE DEFENSA Y REPRESENTACIÓN INSTITUC.
            ['name' => 'Jefe de la Unidad de Defensa y Representación Institucional', 'charge_id' => 4, 'position_group_id' => 21, 'item' => 82],
            ['name' => 'Analista de Procesos Judiciales y Arbitrales', 'charge_id' => 7, 'position_group_id' => 21, 'item' => 83],
            ['name' => 'Analista de Procesos Especiales y Recuperación Patrimonial', 'charge_id' => 9, 'position_group_id' => 21, 'item' => 84],
                // REPRESENTACIÓN DEPARTAMENTAL SANTA CRUZ
            ['name' => 'Representante Departamental Santa Cruz', 'charge_id' => 8, 'position_group_id' => 22, 'item' => 85],
            ['name' => 'Asistente Administrativo Sta. Cruz', 'charge_id' => 13, 'position_group_id' => 22, 'item' => 86],
                // REPRESENTACIÓN DEPARTAMENTAL COCHABAMBA
            ['name' => 'Representante Departamental Cochabamba', 'charge_id' => 8, 'position_group_id' => 23, 'item' => 87],
            ['name' => 'Asistente Administrativo Cbba.', 'charge_id' => 13, 'position_group_id' => 23, 'item' => 88],
                // REPRESENTACIÓN DEPARTAMENTAL ORURO
            ['name' => 'Asistente Departamental Oruro', 'charge_id' => 12, 'position_group_id' => 24, 'item' => 89],
                // REPRESENTACIÓN DEPARTAMENTAL CHUQUISACA
            ['name' => 'Asistente Departamental Chuquisaca', 'charge_id' => 12, 'position_group_id' => 25, 'item' => 90],
                // REPRESENTACIÓN DEPARTAMENTAL POTOSI
            ['name' => 'Asistente Departamental Potosí', 'charge_id' => 12, 'position_group_id' => 26, 'item' => 91],
                // REPRESENTACIÓN DEPARTAMENTAL TARIJA
            ['name' => 'Representante Departamental Tarija', 'charge_id' => 8, 'position_group_id' => 27, 'item' => 92],
                // REPRESENTACIÓN DEPARTAMENTAL BENI
            ['name' => 'Representante Departamental Beni', 'charge_id' => 8, 'position_group_id' => 28, 'item' => 93],
                // REPRESENTACIÓN DEPARTAMENTAL PANDO
            ['name' => 'Representante Departamental Pando', 'charge_id' => 8, 'position_group_id' => 29, 'item' => 94],
        ];
        foreach ($statuses as $status) {
            App\Position::create($status);
        }
    }
}
