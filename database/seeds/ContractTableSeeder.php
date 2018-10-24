<?php

use Illuminate\Database\Seeder;

class ContractTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Contract::class, 200)->create();
        $datas = [
            ['8326080', 'Analista de Ingresos', '01/02/2018', '07/02/2018'],
            ['6096967', 'Técnico de Atención al Afiliado II', '01/02/2018', '07/02/2018'],
            ['2449068', 'Jefe de Unidad Financiera', '02/01/2018', '04/30/2018'],
            ['4268839', 'Secretaria de Dirección', '01/02/2018', '07/02/2018'],
            ['6866195', 'Analista de Procesos de Información contable', '01/02/2018', '07/02/2018'],
            ['6848816', 'Técnico de Control de Aportes', '01/02/2018', '07/02/2018'],
            ['3478970', 'Secretaria de Dirección', '01/02/2018', '07/02/2018'],
            ['5907833', 'Profesional Soporte Técnico', '01/02/2018', '07/02/2018'],
            ['4756336', 'Jefe de la Unidad de Sistemas y Soportes Físico', '01/02/2018', '07/02/2018'],
            ['2286661', 'Encargado de Procesos Técnicos de Patrimonio y Bienes', '02/23/2018', '05/23/2018'],
            ['4285006', 'Director de Beneficios Económicos', '08/01/2016', 'LIBRE NOMBREMIENTO'],
            ['8358651', 'Encargado de Organización y Logística', '01/02/2018', '07/02/2018'],
            ['6117948', 'Analista de Contratación y Adquisiciones', '01/02/2018', '07/02/2018'],
            ['4265887', 'Técnico de Procesamiento y Registro Presupuestario', '01/02/2018', '07/02/2018'],
            ['6629776', 'Responsable de Tesorería', '01/02/2018', '07/02/2018'],
            ['5948875', 'Responsable de Programación y Ejecución Presupuestaria', '01/02/2018', '07/02/2018'],
            ['2616779', 'DIRECTOR GENERAL EJECUTIVO', '09/01/2015', 'LIBRE NOMBREMIENTO'],
            ['9202221', 'Técnico de Recuperación y Cobranzas', '01/02/2018', '07/02/2018'],
            ['4836141', 'analista Legal Fondo de Retiro cuota y Auxilio Mortuorio', '01/02/2018', '07/02/2018'],
            ['3359403', 'Encargado de la Unidad de Gestión Documental y Archivo', '01/02/2018', '07/02/2018'],
            ['4279388', 'Secretaria de Dirección', '01/02/2018', '07/02/2018'],
            ['2379075', 'Director de Asesoramiento Jurídico, Administrativo y Defensa Institucional', '01/02/2018', 'LIBRE NOMBREMIENTO'],
            ['4322190', 'Técnico de Conservación, Patrimonio y Bienes', '03/01/2018', '05/30/2018'],
            ['3342271', 'Jefe de la Unidad Integral Administrativa Institucional', '01/02/2018', '07/02/2018'],
            ['4771553', 'Analista de Desarrollo y Mantenimiento de Software', '01/02/2018', '07/02/2018'],
            ['4771553', 'Jefe de la Unidad de Sistemas y Soportes Físico', '04/23/2018', '07/23/2018'],
            ['3358454', 'Jefe de Unidad de Otorgación de Fondo de Retiro Policial Individual Cuota y Auxilio Mortuorio', '01/02/2018', '07/02/2018'],
            ['5990351', 'Analista en Activos Fijos y Almacenes', '04/09/2018', '07/08/2018'],
            ['6800779', 'Asistente de Conservación, Patrimonio y Bienes', '01/02/2018', '07/02/2018'],
            ['4875775', 'Analista en Programación de Sistemas', '01/15/2018', '07/15/2018'],
            ['8277418', 'Técnico de atención al Afiliado Fondo de Retiro', '01/02/2018', '07/02/2018'],
            ['6835843', 'Analista de Procesos Administrativos y Contratos', '01/02/2018', '07/02/2018'],
            ['3367169', 'Director de Asuntos Administrativos', '03/05/2018', 'LIBRE NOMBREMIENTO'],
            ['4294797', 'Jefe de la Unidad Administrativa', '04/09/2018', '07/08/2018'],
            ['4338808', 'Analista de Procesos Judiciales y Arbitrales', '03/26/2018', '06/25/2018'],
            ['4887592', 'Encargado de Registro, Control y Recuperación de Prestamos', '01/02/2018', '07/02/2018'],
            ['9115203', 'Técnico de Verificación y Validación Documental', '01/02/2018', '07/02/2018'],
            ['4881022', 'Jefe de Unidad de Inversión de Prestamos', '03/26/2018', '06/25/2018'],
            ['4748496', 'Jefe de Unidad de Auditoria Interna', '01/02/2018', '07/02/2018'],
            ['4904484', 'Técnico de Archivo y Manejo de Documentos Contables', '01/02/2018', '07/02/2018'],
            ['6684488', 'Analista Legal del complemento Económico', '02/14/2018', '05/16/2018'],
            ['487687', 'Jefe de la Unidad de Transparencia Institucional', '01/02/2018', '07/02/2018'],
            ['6161763', 'Profesional de Archivo y Gestión Documental de Beneficios Económicos', '01/02/2018', '07/02/2018'],
            ['6722699', 'Encargado de Cuentas Individuales', '23-012018', '04/22/2018'],
            ['6052573', 'Secretaria de Dirección', '01/02/2018', '07/02/2018'],
            ['4837063', 'Auditor Interno', '01/02/2018', '07/02/2018'],
            ['1061549-1U', 'Jefe de la unidad de Recursos Humanos', '01/02/2018', '07/02/2018'],
            ['5695109', 'Técnico de Procesos de Calificación de Fondo de Retiro, Cuota y Auxilio Mortuorio', '01/02/2018', '07/02/2018'],
            ['3350777', 'Contable de Fondos en Avance', '01/02/2018', '07/02/2018'],
            ['2068484', 'Analista Contable de Inversiones', '01/02/2018', '07/02/2018'],
            ['4326798', 'Técnico de Atención al Afiliado I', '01/02/2018', '07/02/2018'],
            ['2430451', 'Profesional en Servicios Generales y Trámites Administrativos', '01/02/2018', '07/02/2018'],
            ['4886229', 'Analista de Procesos Especiales y Recuperación Patrimonial', '01/02/2018', '07/02/2018'],
            ['5954573', 'Analista de Sistemas Contable 1', '01/02/2018', '07/02/2018'],
            ['6076133', 'Jefe de Unidad de Otorgación del Complemento Económico', '01/02/2018', '07/02/2018'],
            ['4907550', 'Auditor Interno', '01/02/2018', '07/02/2018'],
            ['6987176', 'Técnico de Procesos de Calificación Complemento Económico', '01/23/2018', '04/22/2018'],
            ['10931325', 'Técnico de Atención al Afiliado Complemento Económico', '01/02/2018', '07/02/2018'],
            ['5960790', 'Secretaria de Dirección', '01/02/2018', '07/02/2018'],
            ['4851948', 'Asistente y Mensajero', '01/02/2018', '07/02/2018'],
            ['4919607', 'DIRECTOR DE ESTRATEGIAS SOCIALES E INVERSIONES', '07/13/2017', 'LIBRE NOMBREMIENTO'],
            ['3454752', 'Encargado de Calificación Complemento Económico', '01/02/2018', '07/02/2018'],
            ['4885095', 'Secretaria de Honorable Directorio', '01/02/2018', '07/02/2018'],
            ['4781199', 'Responsable de Contabilidad Integrada', '01/02/2018', '07/02/2018'],
            ['6833123', 'Técnico de Atención al Afiliado I', '01/02/2018', '07/02/2018'],
            ['6083462', 'Técnico de Atención al Afiliado I', '01/02/2018', '07/02/2018'],
            ['6102450', 'Jefe de la Unidad de Defensa y Representación Institucional', '03/26/2018', '06/25/2018'],
            ['2259918', 'Asistente de Dirección', '01/02/2018', '07/02/2018'],
            ['4905146', 'Trabajo Social', '03/01/2018', 'COMISION'],
            ['4959444', 'Analista Legal Prestamos', '01/02/2018', '07/02/2018'],
            ['6759405', 'Asesor Jurídico de Directorio', '01/02/2018', '07/02/2018'],
            ['5746099', 'Asistente Departamental Oruro', '01/02/2018', '07/02/2018'],
            ['7555331', 'Representante Departamental Cochabamba', '01/02/2018', '07/02/2018'],
            ['5266782', 'Asistente Administrativo Cbba.', '01/02/2018', '07/02/2018'],
            ['2805120', 'Representante Departamental Santa Cruz', '01/02/2018', '07/02/2018'],
            ['8943438', 'Asistente Administrativo Sta. Cruz', '01/02/2018', '07/02/2018'],
            ['3653169', 'Asistente Departamental Chuquisaca', '01/02/2018', '07/02/2018'],
            ['5500951', 'Asistente Departamental Potosí', '01/02/2018', '07/02/2018'],
            ['5006621', 'Representante Departamental Tarija', '01/02/2018', '07/02/2018'],
            ['1727172', 'Representante Departamental Beni', '01/02/2018', '07/02/2018'],
            ['1765608', 'Representante Departamental Pando', '01/02/2018', '07/02/2018'],
            ['6091225', 'Asistente Camarero', '01/02/2018', '07/02/2018'],
            ['8305603', 'Profesional Administrativo de Hostal Paris', '01/02/2018', '07/02/2018'],
            ['6870739', 'Asistente de Recepción Nocturno', '01/12/2018', '07/18/2018'],
            ['6814151', 'Asistente de Recepción Diurna I', '02/16/2018', '05/14/2018'],
            ['8310665', 'Asistente de Recepción Diurna II', '01/12/2018', '07/18/2018'],
            ['3385877', 'Asistente Camarero', '01/02/2018', '07/02/2018'],
            ['8445876', 'Asistente Turnante', '01/02/2018', '07/02/2018'],
        ];

        foreach ($datas as $data) {
            $contract = new App\Contract();
            $employee = App\Employee::where('identity_card', $data[0])->first();
            $position = App\Position::where('name', 'iLIKE', '%'.$data[1].'%')->first();
            $contract->employee_id = $employee->id;
            if ($data[0] == '3478970') {
                $contract->position_id = 54;
            }
            if ($data[0] == '6052573') {
                $contract->position_id = 16;
            }
            if ($data[0] == '5960790') {
                $contract->position_id = 2;
            }
            $contract->position_id = $position->id;
            $contract->date_start = date('Y-m-d', strtotime($data[2]));
            $contract->date_end = date('Y-m-d', strtotime($data[3]));
            $contract->status = true;
            $contract->save();
        }
    }
}
