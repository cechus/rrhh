<?php

namespace App\Http\Controllers\API;

use App\Contract;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset = $request->offset ?? 0;
        $limit = $request->limit ?? 10;
        $sort = $request->sort ?? 'id';
        $order = $request->order ?? 'asc';
        $last_name = strtoupper($request->last_name) ?? '';
        $first_name = strtoupper($request->first_name) ?? '';
        $second_name = strtoupper($request->second_name) ?? '';
        $mothers_last_name = strtoupper($request->mothers_last_name) ?? '';
        $surname_husband = strtoupper($request->surname_husband) ?? '';
        $identity_card = strtoupper($request->identity_card) ?? '';
        $total = Employee::select('employees.id')//,'identity_card','registration','degrees.name as degree','first_name','second_name','last_name','mothers_last_name','civil_status')->
            ->whereRaw("coalesce(employees.first_name,'' ) LIKE '$first_name%'")
            ->whereRaw("coalesce(employees.second_name,'' ) LIKE '$second_name%'")
            ->whereRaw("coalesce(employees.last_name,'') LIKE '$last_name%'")
            ->whereRaw("coalesce(employees.mothers_last_name,'') LIKE '$mothers_last_name%'")
            ->whereRaw("coalesce(employees.surname_husband,'') LIKE '$surname_husband%'")
            ->whereRaw("coalesce(employees.identity_card, '') LIKE '$identity_card%'")
            ->count();

        $contracts = Contract::select(
            'contracts.id',
            'employees.id as employee_id',
            'employees.identity_card',
            'cities.shortened as city_identity_card',
            'employees.first_name',
            'employees.second_name',
            'employees.surname_husband',
            'employees.last_name',
            'employees.mothers_last_name',
            'employees.birth_date',
            'employees.account_number',
            'management_entities.name as management_entity',
            'positions.name as position',
            'charges.base_wage',
            'charges.name as charge'
        )
        ->where('status', true)
        ->leftJoin('employees', 'contracts.employee_id', '=', 'employees.id')
        ->leftJoin('cities', 'cities.id', '=', 'employees.city_identity_card_id')
        ->leftJoin('management_entities', 'employees.management_entity_id', '=', 'management_entities.id')
        ->leftJoin('positions', 'contracts.position_id', '=', 'positions.id')
        ->leftJoin('charges', 'positions.charge_id', '=', 'charges.id')
        ->get();

        return response()->json(['contracts' => $contracts->toArray(), 'total' => $total]);

        $employees = Employee::select(
            'employees.id',
            'identity_card',
            'cities.first_shortened as city_identity_card',
            'first_name',
            'second_name',
            'surname_husband',
            'last_name',
            'mothers_last_name',
            'birth_date',
            'account_number',
            'management_entities.name as management_entity',
            'positions.name as position',
            'charges.base_wage',
            'charges.name as charge'
        )
        // ->skip($offset)
            // ->take($limit)
            ->orderBy($sort, $order)
            ->leftJoin('management_entities', 'management_entities.id', '=', 'employees.management_entity_id')
            ->leftJoin('positions', 'positions.employee_id', '=', 'employees.id')
            ->leftJoin('charges', 'charges.id', '=', 'positions.id')
            ->leftJoin('cities', 'cities.id', '=', 'employees.city_identity_card_id')
            ->whereRaw("coalesce(employees.first_name,'' ) LIKE '$first_name%'")
            ->whereRaw("coalesce(employees.second_name,'' ) LIKE '$second_name%'")
            ->whereRaw("coalesce(employees.last_name,'') LIKE '$last_name%'")
            ->whereRaw("coalesce(employees.mothers_last_name,'') LIKE '$mothers_last_name%'")
            ->whereRaw("coalesce(employees.surname_husband,'') LIKE '$surname_husband%'")
            ->whereRaw("coalesce(employees.identity_card, '') LIKE '$identity_card%'")
            ->get();

        return response()->json(['employees' => $employees->toArray(), 'total' => $total]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
