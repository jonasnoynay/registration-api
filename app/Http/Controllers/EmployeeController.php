<?php

namespace App\Http\Controllers;

use Validator;
use App\Winner;
use App\Employee;
use App\Participant;
use App\Preregistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EmployeeTableResource;
use App\Http\Resources\ParticipantCollection;
use App\Http\Resources\PreregisteredResource;
use App\Http\Resources\PreregisteredCollection;
use App\Http\Resources\ParticipantTableResource;

class EmployeeController extends Controller
{
    /**
     * Search employee by keyword
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchEmployeeList(Request $request)
    {
        //get keyword
        $keyword = $request->keyword;

        //find employee by fullname or keyword
        $results = Preregistered::whereRaw('(fullname like "%'.$keyword.'%" OR idnumber like "%'.$keyword.'%")')
        ->where('registered', Preregistered::REGISTERED_FALSE)->limit(5)->get();

        //return suggestions
        return response()->json(new PreregisteredCollection($results));
    }
    /**
     * Register employee
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerEmployee(Request $request)
    {
        //get keyword
        $employeeid = $request->employeeid;

        //find employee by id
        $employee = Preregistered::findOrFail($employeeid);

        if(!$employee) {
            return response()->json(['message' => 'You are not pre-registered. Please inform the event coordinator.'], 404);
        }

        $employee->registered = Preregistered::REGISTERED_TRUE;
        $employee->save();

        //return suggestions
        return response()->json(new PreregisteredResource($employee));
    }
    
    /**
     * Get participants
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParticipants()
    {
        // $participants = Preregistered::whereRaw('id NOT IN (select w.preregistered_id from winners w where w.preregistered_id = preregistered.id)')
        // ->where('registered', Preregistered::REGISTERED_TRUE)
        // ->orderByRaw('RAND()')->limit(12)->get();

        $participants = Participant::orderByRaw('RAND()')->limit(12)->get();

        //return participants
        return response()->json(new ParticipantCollection($participants));
    }

    /**
     * Participant Win
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function participantWin(Request $request)
    {
        $win = Winner::updateOrCreate(['prize_id' => $request->prize_id], ['preregistered_id' => $request->employee_id]);

       //return win data
       return response()->json($win); 
    }

    /**
     * Employee table list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function employeesTable(Request $request)
    {
        $employees = Preregistered::select('id', 'idnumber', 'fullname', 'registered');

        //dd($request->get('filterRegistered', []));
        if($request->get('filterRegistered')) {

            $registered = collect($request->filterRegistered)->map(function($reg){
                return $reg == 'Yes' ? Preregistered::REGISTERED_TRUE : Preregistered::REGISTERED_FALSE;
            });

            if($registered->count() > 0) {
                $employees = $employees->whereIn('registered', $registered->toArray());
            }
        }
        if($request->get('searchString')) {
            $searchString = $request->get('searchString');
            $employees = $employees->whereRaw("(idnumber LIKE '%".$searchString."%' OR fullname LIKE '%".$searchString."%')");
        }

        $employees = $employees->paginate($request->get('per_page', 10));

        $employees = EmployeeTableResource::collection($employees);

        return response()->json($employees->resource);
    }

    /**
     * Participants table list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function participantsTable(Request $request)
    {
        $participants = Participant::select('id', 'fullname');

        if($request->get('searchString')) {
            $searchString = $request->get('searchString');
            $participants = $participants->whereRaw("(fullname LIKE '%".$searchString."%')");
        }

        $participants = $participants->paginate($request->get('per_page', 10));

        $participants = ParticipantTableResource::collection($participants);

        return response()->json($participants->resource);
    }

    /**
     * Insert excel data to db
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertExcel(Request $request)
    {
        $dataList = $request->get('data');
        $toInsert = [];

        if(is_array($dataList) && count($dataList) > 0) {
            foreach($dataList as $emp) {
                if(is_array($emp) && count($emp) >= 2) {

                    $idnumber = sprintf("%04d", $emp[0]);

                    $check = Preregistered::where('idnumber', $idnumber)->first();

                    if(!$check) {
                        $toInsert[] = [
                            'idnumber' => $idnumber,
                            'fullname' => $emp[1]
                        ];
                    }
                }
            }
        }

        if(count($toInsert) > 0) DB::table('preregistered')->insert($toInsert);

        return response()->json(['success' => true]);
    }

    /**
     * Insert excel data to db
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertParticipants(Request $request)
    {
        $dataList = $request->get('data');

        $toInsert = [];

        if(is_array($dataList) && count($dataList) > 0) {
            foreach($dataList as $emp) {
                if(is_array($emp) && count($emp) >= 1) {

                    $check = Participant::where('fullname', $emp[0])->first();

                    if(!$check) {
                        $toInsert[] = [
                            'fullname' => $emp[0]
                        ];
                    }
                }
            }
        }

        if(count($toInsert) > 0) DB::table('participants')->insert($toInsert);

        return response()->json(['success' => true]);
    }

    /**
     * Delete participants
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteParticipants(Request $request)
    {
        $ids = $request->get('ids');

        if(is_array($ids) && count($ids) > 0) {
            $deleted = Participant::whereIn('id', $ids)->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Delete Employees
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEmployees(Request $request)
    {
        $ids = $request->get('ids');

        if(is_array($ids) && count($ids) > 0) {
            $deleted = Preregistered::whereIn('id', $ids)->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Update employee
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEmployee(Request $request, $id = 0)
    {
        $employee = Preregistered::findOrFail($id);

        $employee->idnumber = $request->idnumber;
        $employee->fullname = $request->fullname;
        $employee->registered = $request->registered == 'Yes' ? Preregistered::REGISTERED_TRUE: Preregistered::REGISTERED_FALSE;
        $employee->save();

        return response()->json(['success' => true]);
    }
}
