<?php

namespace App\Http\Controllers;

use App\Helpers\Util;
use App\Procedure;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function print($year, $month)
    {
        $procedure = Procedure::select('procedures.id')
                        ->leftJoin('months', 'months.id', '=', 'procedures.month_id')
                        ->whereRaw("lower(months.name) like '".strtolower($month)."'")
                        ->where('year', '=', $year)
                        ->first();
        if (!$procedure) {
            return 'procedure not found';
        }
        $procedure = Procedure::with('month')->find($procedure->id);
        // $payrolls = $procedure->payrolls()->skip(5)->take(10)->get();
        $payrolls = $procedure->payrolls;
        foreach ($payrolls as $key => $payroll) {
            $contract = $payroll->contract;
            $position = $contract->position;
            $charge = $position->charge;
            $employee = $contract->employee;
            $payroll->contract_id = $contract->id;
            $payroll->ci_ext = Util::ciExt($employee);
            $payroll->employee_id = $employee->id;
            $payroll->city_identity_card = $employee->city_identity_card->shortened;
            $payroll->full_name = Util::fullName($employee);
            $payroll->birth_date = Carbon::parse($employee->birth_date)->format('d/m/Y');
            $payroll->account_number = $employee->account_number;
            $payroll->nua_cua = $employee->nua_cua;
            $payroll->charge = $charge->name;
            $payroll->position = $position->name;
            $payroll->base_wage = $charge->base_wage;
            $payroll->management_entity = $employee->management_entity->name;
            $payroll->code_image = \DNS2D::getBarcodePNG(($payroll->id.' '.$contract->id.' '.$position->id.' '.$charge->id.' '.$employee->id), 'PDF417', 3, 33, [1, 1, 1]);
        }
        $file_name = 'Boletas de Pago de '.$procedure->month->name.' de '.$procedure->year.'.pdf';
        $data = [
            'payrolls'  => $payrolls,
            'procedure' => $procedure,
        ];
        // return view('print.temp');
        // return view('tickets.print',$data);
        return \PDF::loadView('tickets.print', $data)
            ->setOption('page-width', '216')
            ->setOption('page-height', '356')
            // ->setPaper('letter')
            ->setOption('margin-top', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 4)
            ->setOption('margin-right', 4)
            ->setOption('encoding', 'utf-8')
            ->stream($file_name);
    }
}
