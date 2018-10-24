<?php

namespace App\Http\Controllers;

use App\Contract;
use App\DiscountPayroll;
use App\Month;
use App\Payroll;
use App\Position;
use App\Procedure;
use Excel;
use Illuminate\Http\Request;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Worksheet_Drawing;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [

        ];

        return view('report.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getExcel(Request $request, $year, $month)
    {

        // global $data;
        // $data = $request;
        $month = Month::whereRaw("lower(name) like '".strtolower($month)."'")->first();
        if (!$month) {
            return 'month not found';
        }
        Excel::create('Planilla Laboral - '.date('Y-m-d H:i:s'), function ($excel) use ($year, $month) {
            // Set the title
            $excel->setTitle('Laboral');

            // Chain the setters
            $excel->setCreator('unidad de sistemas')
                    ->setCompany('MUSERPOL');

            // Call them separately
            $excel->setDescription('description');

            $excel->sheet('Laboral', function ($sheet) use ($year, $month) {
                $center_style = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $sheet->setShowGridlines(true);
                $sheet
                    ->getPageSetup()
                    ->setPrintArea('A1:E5,G4:M20');

                $name = 'MUTUAL DE SERVICIOS AL POLICIA LABORAL';
                $nit = 'NIT 234578021';
                $address = 'Av. 6 De Agosto No. 2354 - Zona Sopocachi';
                $title = 'PLANILLA DE HABERES';
                $subtitle = 'PERSONAL EVENTUAL - MES '.$month.' DE '.$year.'';
                $exchange = '(EXPRESADO EN BOLIVIANOS)';
                $sheet->mergeCells('A1:C1');
                $sheet->mergeCells('A2:C2');
                $sheet->mergeCells('A3:C3');

                $sheet->row(1, [
                    $name,
                ]);
                $sheet->row(2, [
                    $nit,
                ]);
                $sheet->row(3, [
                    $address,
                ]);

                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setPath(public_path('images/logo.jpg')); //your image path
                $objDrawing->setCoordinates('E1');
                $objDrawing->setHeight(74);
                $objDrawing->setWorksheet($sheet);

                $sheet->mergeCells('A5:Z5');
                $sheet->getStyle('A5:Z5')->applyFromArray($center_style);
                $sheet->mergeCells('A6:Z6');
                $sheet->getStyle('A6:Z6')->applyFromArray($center_style);
                $sheet->mergeCells('A7:Z7');
                $sheet->getStyle('A7:Z7')->applyFromArray($center_style);

                $sheet->row(5, [
                    $title,
                ]);
                $sheet->row(6, [
                    $subtitle,
                ]);
                $sheet->row(7, [
                    $exchange,
                ]);

                $row = 10;
                $sheet->getStyle($row)->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('FF808080');
                $da = [
                    'Renta vejez 10%',
                    'Riesgo común 1,71%',
                    'Comisión 0,5%',
                    'Aporte solidario del asegurado 0,5%',
                    'Aporte Nacional solidario 1%, 5%, 10%',
                ];
                $sheet->row($row++, [
                    'Nº',
                    'C.I.',
                    'TRABAJADOR',
                    'SUCURSAL',
                    'CUENTA BANCO UNION',
                    'FECHA NACIMIENTO',
                    'SEXO',
                    'CARGO',
                    'PUESTO',
                    'FECHA DE INGRESO',
                    'FECHA VENCIMIENTO CONTRATO',
                    'DIAS TRABAJADOS',
                    'HABER BASICO',
                    'TOTAL GANADO',
                    'AFP',
                    'Renta vejez 10%',
                    'Riesgo común 1,71%',
                    'Comisión 0,5%',
                    'Aporte solidario del asegurado 0,5%',
                    'Aporte Nacional solidario 1%, 5%, 10%',
                    'TOTAL DESCUENTOS DE LEY',
                    'SUELDO NETO',
                    'RC-IVA 13%',
                    'Desc. Atrasos, Abandonos, Faltas y Licencia S/G Haberes',
                    'TOTAL DESCUENTOS',
                    'LIQUIDO PAGABLE',
               ]);
                $procedure = Procedure::where('month_id', $month->id)->where('year', $year)->select('id')->first();
                if (isset($procedure->id)) {
                    $payrolls = Payroll::where('procedure_id', $procedure->id)->get();
                    $number = 1;
                    foreach ($payrolls as $payroll) {
                        $contract = $payroll->contract; //Contract::where('employee_id',$employee->id)->where('status',true)->first();
                        $employee = $contract->employee;
                        $position = $contract->position; //Position::where('employee_id',$employee->id)->first();
                        //$discount = DiscountPayroll::where('payroll_id',$payroll->id)->get();
                        //$i
                        //$discount = DiscountPayroll::where('payroll_id',$payroll->id)->select('id','amount')->orderBy('discount_id','asc')->get()->pluck('amount','id');
                        $sheet->row($row++, [
                            $number++,
                            $employee->identity_card,
                            $employee->last_name.' '.$employee->mothers_last_name.' '.$employee->first_name.' '.$employee->second_name,
                            $employee->group_job->name ?? 'Central',
                            $employee->account_number,
                            date('d/m/Y', strtotime($employee->birth_date)),
                            $employee->gender,
                            $position->charge->name ?? '',
                            $position->name ?? '',
                            date('d/m/Y', strtotime($contract->date_start)),
                            date('d/m/Y', strtotime($contract->date_end)),
                            $payroll->worked_days,
                            $payroll->base_wage ?? '0',
                            $payroll->quotable,
                            $employee->management_entity->name,
                            $payroll->discount_old,
                            $payroll->discount_common_risk,
                            $payroll->discount_commission,
                            $payroll->discount_solidary,
                            $payroll->discount_national,
                            $payroll->total_amount_discount_law,
                            $payroll->net_salary,
                            $payroll->discount_rc_iva,
                            $payroll->total_amount_discount_institution,
                            $payroll->total_discounts,
                            $payroll->payable_liquid,
                        ]);
                    }
                }
            });
        })->download('xls');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Procedure $procedure
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Procedure $procedure
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Procedure $procedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Procedure           $procedure
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procedure $procedure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Procedure $procedure
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedure $procedure)
    {
        //
    }

    private function generateReportLaboral(Request $request)
    {

        // global $data;
        // $data = $request;

        // Excel::create('Filename', function($excel) {
        //     // Set the title
        //     $excel->setTitle('Laboral');

        //     // Chain the setters
        //     $excel->setCreator('unidad de sistemas')
        //             ->setCompany('MUSERPOL');

        //     // Call them separately
        //     $excel->setDescription('description');

        //     $excel->sheet('Laboral', function($sheet) {
        //         $center_style = array(
        //             'alignment' => array(
        //                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        //             )
        //         );

        //         $name = "MUTUAL DE SERVICIOS AL POLICIA".$data->type;
        //         $nit = "NIT 234578021";
        //         $address = "Av. 6 De Agosto No. 2354 - Zona Sopocachi";
        //         $title = "PLANILLA DE HABERES";
        //         $subtitle = "PERSONAL EVENTUAL - MES  ABRIL DE 2018";
        //         $exchange = "(EXPRESADO EN BOLIVIANOS)";
        //         $sheet->mergeCells('A1:C1');
        //         $sheet->mergeCells('A2:C2');
        //         $sheet->mergeCells('A3:C3');

        //         $sheet->row(1, array(
        //             $name
        //         ));
        //         $sheet->row(2, array(
        //             $nit
        //         ));
        //         $sheet->row(3, array(
        //             $address
        //         ));

        //         $objDrawing = new PHPExcel_Worksheet_Drawing;
        //         $objDrawing->setPath(public_path('images/logo.jpg')); //your image path
        //         $objDrawing->setCoordinates('E1');
        //         $objDrawing->setHeight(74);
        //         $objDrawing->setWorksheet($sheet);

        //         $sheet->mergeCells('A5:Z5');
        //         $sheet->getStyle("A5:Z5")->applyFromArray($center_style);
        //         $sheet->mergeCells('A6:Z6');
        //         $sheet->getStyle("A6:Z6")->applyFromArray($center_style);
        //         $sheet->mergeCells('A7:Z7');
        //         $sheet->getStyle("A7:Z7")->applyFromArray($center_style);

        //         $sheet->row(5, array(
        //             $title
        //         ));
        //         $sheet->row(6, array(
        //             $subtitle
        //         ));
        //         $sheet->row(7, array(
        //             $exchange
        //         ));

        //         $row = 10;
        //         $sheet->getStyle($row)->getFill()
        //         ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
        //         ->getStartColor()
        //         ->setARGB('FF808080');
        //         $da = [
        //             'Renta vejez 10%',
        //             'Riesgo común 1,71%',
        //             'Comisión 0,5%',
        //             'Aporte solidario del asegurado 0,5%',
        //             'Aporte Nacional solidario 1%, 5%, 10%',
        //         ];
        //         $sheet->row($row++, array(
        //             'Nº',
        //             'C.I.',
        //             'TRABAJADOR',
        //             'SUCURSAL',
        //             'CUENTA BANCO UNION',
        //             'FECHA NACIMIENTO',
        //             'SEXO',
        //             'CARGO',
        //             'PUESTO',
        //             'FECHA DE INGRESO',
        //             'FECHA VENCIMIENTO CONTRATO',
        //             'DIAS TRABAJADOS',
        //             'HABER BASICO',
        //             'TOTAL GANADO',
        //             'AFP',
        //             'Renta vejez 10%',
        //             'Riesgo común 1,71%',
        //             'Comisión 0,5%',
        //             'Aporte solidario del asegurado 0,5%',
        //             'Aporte Nacional solidario 1%, 5%, 10%',
        //             'TOTAL DESCUENTOS DE LEY',
        //             'SUELDO NETO',
        //             'RC-IVA 13%',
        //             'Desc. Atrasos, Abandonos, Faltas y Licencia S/G Haberes',
        //             'TOTAL DESCUENTOS',
        //             'LIQUIDO PAGABLE',
        //        ));
        //        $payrolls = Payroll::get();
        //        $number = 1;
        //        foreach($payrolls as $payroll){

        //         $contract = $payroll->contract; //Contract::where('employee_id',$employee->id)->where('status',true)->first();
        //         $employee = $contract->employee;
        //         $position = $contract->position;//Position::where('employee_id',$employee->id)->first();
        //         //$discount = DiscountPayroll::where('payroll_id',$payroll->id)->get();
        //         //$i
        //         //$discount = DiscountPayroll::where('payroll_id',$payroll->id)->select('id','amount')->orderBy('discount_id','asc')->get()->pluck('amount','id');
        //         $sheet->row($row++, array(
        //             $number++,
        //             $employee->identity_card,
        //             $employee->last_name.' '.$employee->mothers_last_name.' '.$employee->first_name.' '.$employee->mothers_last_name,
        //             $employee->group_job->name??'Central',
        //             $employee->account_number,
        //             date("d/m/Y", strtotime($employee->birth_date)),
        //             $employee->gender,
        //             $position->charge->name??'',
        //             $position->name??'',
        //             date("d/m/Y", strtotime($contract->date_start)),
        //             date("d/m/Y", strtotime($contract->date_end)),
        //             $payroll->worked_days,
        //             $position->base_wage ?? '0',
        //             $payroll->quotable,
        //             $employee->management_entity->name,
        //             $payroll->discount_old,
        //             $payroll->discount_common_risk,
        //             $payroll->discount_commission,
        //             $payroll->discount_solidary,
        //             $payroll->discount_national,
        //             $payroll->total_amount_discount_law,
        //             $payroll->payable_liquid,
        //             0,
        //             $payroll->total_amount_discount_institution,
        //             $payroll->total_discounts,
        //             $payroll->payable_liquid
        //         ));
        //        }
        //     });
        // })->download('xls');
    }
}
