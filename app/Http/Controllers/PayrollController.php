<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Employee;
use App\Month;
use App\Payroll;
use App\Procedure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = Procedure::with('month')->orderBy('year', 'asc')->orderBy('month_id', 'desc')->get();
        $data = [
            'procedures'=> $procedures,
        ];

        return view('payroll.index', $data);
    }

    public function create($year, $month)
    {
        $months = array_map(function ($v) {
            return strtolower($v);
        }, Month::pluck('name')->toArray());

        //add more validations
        if ($year <= Carbon::now()->year && in_array(strtolower($month), $months)) {
            $procedure = Procedure::select('procedures.id')
                ->leftJoin('months', 'months.id', '=', 'procedures.month_id')
                ->whereRaw("lower(months.name) like '".strtolower($month)."'")
                ->where('year', '=', $year)
                ->first();
            if (!$procedure) {
                return 'procedure not found';
            }
            $procedure = Procedure::with('month')->find($procedure->id);

            return view('payroll.create', compact('year', 'month', 'procedure'));
        } else {
            return 'error';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = Month::whereRaw("lower(name) like '".strtolower($request->month)."'")->first();
        if (!$month) {
            return 'month not found';
        }
        $procedure = Procedure::select('procedures.id')
                                ->leftJoin('months', 'months.id', '=', 'procedures.month_id')
                                ->whereRaw("lower(months.name) like '".strtolower($request->month)."'")
                                ->where('year', '=', $request->year)
                                ->first();
        if (!$procedure) {
            $procedure = new Procedure();
            $procedure->month_id = $month->id;
            $procedure->year = (int) $request->year;
            $procedure->name = 'planilla de '.$request->year.' '.$request->month;
            $procedure->save();
        } else {
            $procedure = Procedure::find($procedure->id);
        }
        // Procedure::where('year', $request->year)->where('month', $request)
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'contract-') !== false) {
                preg_match('/\d{1,}/', $key, $matches);
                $id = (int) $matches[0];
                $contract = Contract::find($id);
                $payroll = $contract->payrolls()->where('procedure_id', $procedure->id)->first();
                if (!$payroll) {
                    $payroll = new Payroll();

                    $last_payrol = Payroll::orderBy('id', 'DESC')->first();
                    $year = date('y');
                    if (!isset($last_payrol->code) || $last_payrol->code == '') {
                        $payroll->code = '1-'.$year;
                    } else {
                        $data = explode('-', $last_payrol->code);
                        if (!isset($data[1])) {
                            $payroll->code = '1-'.$year;
                        } else {
                            $payroll->code = ($year != $data[1] ? '1' : ($data[0] + 1)).'-'.$year;
                        }
                    }
                }
                $payroll->contract_id = $id;
                $payroll->procedure_id = $procedure->id;
                $payroll->name = 'Personal Eventual - Mes '.$request->month.' de '.$request->year;
                $payroll->worked_days = $value[0];
                $base_wage = $contract->position->charge->base_wage ?? 1000;
                $payroll->base_wage = $base_wage;
                $quotable = ($base_wage / 30) * $value[0];
                $payroll->quotable = $quotable;
                $payroll->discount_old = ($quotable * $procedure->discount_old) / 100;
                $payroll->discount_common_risk = ($quotable * $procedure->discount_common_risk) / 100;
                $payroll->discount_commission = ($quotable * $procedure->discount_commission) / 100;
                $payroll->discount_solidary = ($quotable * $procedure->discount_solidary) / 100;
                $payroll->discount_national = ($quotable * $procedure->discount_national) / 100;
                $total_discount_law = (($quotable * $procedure->discount_old) / 100) + (($quotable * $procedure->discount_common_risk) / 100) + (($quotable * $procedure->discount_commission) / 100) + (($quotable * $procedure->discount_solidary) / 100) + (($quotable * $procedure->discount_national) / 100);
                $payroll->total_amount_discount_law = $total_discount_law;
                $payroll->net_salary = $quotable - $total_discount_law;
                $payroll->discount_rc_iva = floatval($value[1]);
                $payroll->discount_faults = floatval($value[2]);
                $payroll->total_amount_discount_institution = floatval($value[2]);
                $total_discounts = $total_discount_law + floatval($value[2]);
                $payroll->total_discounts = $total_discounts;
                $payroll->payable_liquid = $quotable - $total_discounts;

                $payroll->save();
            }
        }

        return redirect(url('payroll'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Payroll $payroll
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Payroll $payroll
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($year, $month)
    {
        $months = array_map(function ($v) {
            return strtolower($v);
        }, Month::pluck('name')->toArray());
        //add more validations
        if ($year <= Carbon::now()->year && in_array(strtolower($month), $months)) {
            $procedure = Procedure::select('procedures.id')
                ->leftJoin('months', 'months.id', '=', 'procedures.month_id')
                ->whereRaw("lower(months.name) like '".strtolower($month)."'")
                ->where('year', '=', $year)
                ->first();
            $procedure = Procedure::with('month')->find($procedure->id);

            return view('payroll.edit', compact('year', 'month', 'procedure'));
        } else {
            return 'error';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Payroll             $payroll
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payroll $payroll
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }

    public function employee_payroll(Employee $employee)
    {
        return $employee;
    }

    private function generateExcelLaboral()
    {
        Excel::create('Filename', function ($excel) {
            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                    ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

            $excel->sheet('Sheetname', function ($sheet) {
                $center_style = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $name = 'MUTUAL DE SERVICIOS AL POLICIA';
                $nit = 'NIT 234578021';
                $address = 'Av. 6 De Agosto No. 2354 - Zona Sopocachi';
                $title = 'PLANILLA DE HABERES';
                $subtitle = 'PERSONAL EVENTUAL - MES  ABRIL DE 2018';
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
                $payrolls = Payroll::get();
                $number = 1;
                foreach ($payrolls as $payroll) {
                    $employee = $payroll->employee;
                    $contract = Contract::where('employee_id', $employee->id)->where('status', true)->first();

                    $sheet->row($row++, [
                    $number++,
                    $employee->identity_card,
                    $employee->last_name.' '.$employee->mothers_last_name.' '.$employee->first_name.' '.$employee->mothers_last_name,
                    $employee->group_job ?? 'Central',
                    $employee->account_number,
                    $employee->birth_date,
                    $employee->gender,
                    '1',
                    $employee->employee_type->name,
                    $contract->date_start,
                    $contract->date_end,
                    $payroll->worked_days,
                    $contract->base_wage,
                    $payroll->quotable,
                    $payroll->managment_entity->name,
                    $payroll->quotable * 0.1,
                    $payroll->quotable * 0.171,
                    $payroll->quotable * 0.05,
                    0,
                    $payroll->total_amount_discount_institution,
                    $payroll->payable_liquid,
                    0,
                    $payroll->total_discounts,
                    $payroll->total_discounts,
                    $payroll->payable_liquid,
                ]);
                }
            });
        })->download('xls');
    }

    private function generateExcelPatronal()
    {
        Excel::create('Filename', function ($excel) {
            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                    ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

            $excel->sheet('Sheetname', function ($sheet) {
                $center_style = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $name = 'MUTUAL DE SERVICIOS AL POLICIA';
                $nit = 'NIT 234578021';
                $address = 'Av. 6 De Agosto No. 2354 - Zona Sopocachi';
                $title = 'PLANILLA PATRONAL';
                $subtitle = 'PERSONAL EVENTUAL - MES  ABRIL DE 2018';
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

                $sheet->mergeCells('A5:N5');
                $sheet->getStyle('A5:N5')->applyFromArray($center_style);
                $sheet->mergeCells('A6:N6');
                $sheet->getStyle('A6:N6')->applyFromArray($center_style);
                $sheet->mergeCells('A7:N7');
                $sheet->getStyle('A7:N7')->applyFromArray($center_style);

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
                $sheet->row($row++, [
                    'Nº',
                    'C.I.',
                    'TRABAJADOR',
                    'SUCURSAL',
                    'PUESTO',
                    'FECHA INGRESO',
                    'TOTAL GANADO',
                    'DIAS TRABAJADOS',
                    'AFP',
                    'CNS 10%',
                    'Riesgo profesional 1,71%',
                    'Aporte Patronal Solidario 3%',
                    'Aporte patronal para vivienda 2%',
                    'TOTAL A PAGAR',
               ]);
                $payrolls = Payroll::get();
                $number = 1;
                foreach ($payrolls as $payroll) {
                    $employee = $payroll->employee;
                    $contract = Contract::where('employee_id', $employee->id)->where('status', true)->first();

                    $sheet->row($row++, [
                    $number++,
                    $employee->identity_card,
                    $employee->last_name.' '.$employee->mothers_last_name.' '.$employee->first_name.' '.$employee->mothers_last_name,
                    $employee->group_job->name ?? 'Central',
                    $employee->employee_type->name,
                    $contract->date_start,
                    $payroll->quotable,
                    $payroll->worked_days,
                    $employee->management_entity->name,
                    $payroll->quotable * 0.1,
                    $payroll->quotable * 0.171,
                    $payroll->quotable * 0.03,
                    $payroll->quotable * 0.02,
                    $payroll->payable_liquid,
                ]);
                }
            });
        })->download('xls');
    }

    private function generateExcelTributaria()
    {
        Excel::create('Filename', function ($excel) {
            // Set the title
            $excel->setTitle('Our new awesome title');

            // Chain the setters
            $excel->setCreator('Maatwebsite')
                    ->setCompany('Maatwebsite');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

            $excel->sheet('Sheetname', function ($sheet) {
                $center_style = [
                    'alignment' => [
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ],
                ];

                $name = 'MUTUAL DE SERVICIOS AL POLICIA';
                $nit = 'NIT 234578021';
                $address = 'Av. 6 De Agosto No. 2354 - Zona Sopocachi';
                $title = 'PLANILLA PATRONAL';
                $subtitle = 'PERSONAL EVENTUAL - MES  ABRIL DE 2018';
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

                $sheet->mergeCells('A5:N5');
                $sheet->getStyle('A5:N5')->applyFromArray($center_style);
                $sheet->mergeCells('A6:N6');
                $sheet->getStyle('A6:N6')->applyFromArray($center_style);
                $sheet->mergeCells('A7:N7');
                $sheet->getStyle('A7:N7')->applyFromArray($center_style);

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
                $sheet->row($row++, [
                    'Nº',
                    'C.I.',
                    'TRABAJADOR',
                    'SUCURSAL',
                    'SUELDO NETO',
                    'Minimo No imponible',
                    'Diferencia sujeto a impuestos',
                    'Impuesto 13% Debito Fisca',
                    'Computo IVA según D.J. Form. 110',
                    '13% Sobre 2 Min. Nal.',
                    'Fisco',
                    'Dependiente',
                    'Mes anterior',
                    'Actualizacion',
                    'Total',
                    'Saldo a favor del dependiente',
                    'Saldo Utilizado',
                    'Impuesto determinado a pagar',
                    'Saldo para mes siguiente',
               ]);
                $payrolls = Payroll::get();
                $number = 1;
                $basic_salary = 4000;
                $basic_salary_tax = $basic_salary * 0.13;
                foreach ($payrolls as $payroll) {
                    $employee = $payroll->employee;
                    $contract = Contract::where('employee_id', $employee->id)->where('status', true)->first();
                    $tax = $payroll->payable_liquid - 40000 > 0 ? $payroll->payable_liquid - 40000 : 0;
                    $sheet->row($row++, [
                    $number++,
                    $employee->identity_card,
                    $employee->last_name.' '.$employee->mothers_last_name.' '.$employee->first_name.' '.$employee->mothers_last_name,
                    $employee->group_job->name ?? 'Central',
                    $payroll->payable_liquid,
                    $basic_salary,
                    $tax,
                    '0',
                    $basic_salary_tax,
                    '0f',
                    '0D',
                    '0m',
                    '0A',
                    '0T',
                    '0S',
                    '0u',
                    '0I',
                    '0sig',
                ]);
                }
            });
        })->download('xls');
    }
}
