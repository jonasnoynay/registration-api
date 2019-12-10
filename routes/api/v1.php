<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->post('employees/search', ['uses' => 'EmployeeController@searchEmployeeList', 'as' => 'employee.search.list']);
$router->post('employee/register', ['uses' => 'EmployeeController@registerEmployee', 'as' => 'employee.register']);
$router->get('prizes',['uses'=> 'PrizeController@getPrizes', 'as' => 'prizes.get']);
$router->get('prizes/table',['uses'=> 'PrizeController@prizesTable', 'as' => 'prizes.table']);
$router->get('participants',['uses'=> 'EmployeeController@getParticipants', 'as' => 'participants.get']);
$router->post('participant/win',['uses'=> 'EmployeeController@participantWin', 'as' => 'participant.win']);
$router->post('participant/new',['uses'=> 'EmployeeController@addNewParticipant', 'as' => 'participant.add']);

$router->get('employees/table', ['uses'=>'EmployeeController@employeesTable', 'as' => 'employees.table']);
$router->post('employees/excel/insert', ['uses'=>'EmployeeController@insertExcel', 'as' => 'employees.insert.excel']);
$router->delete('employees/delete', ['uses'=>'EmployeeController@deleteEmployees', 'as' => 'employees.delete']);
$router->put('employee/update/{id}', ['uses'=>'EmployeeController@updateEmployee', 'as' => 'employees.update']);
$router->post('employee/new', ['uses'=>'EmployeeController@addNewEmployee', 'as' => 'employees.add']);

$router->get('participants/table', ['uses'=>'EmployeeController@participantsTable', 'as' => 'participants.table']);
$router->post('participants/excel/insert', ['uses'=>'EmployeeController@insertParticipants', 'as' => 'participants.insert.excel']);
$router->delete('participants/delete', ['uses'=>'EmployeeController@deleteParticipants', 'as' => 'participants.delete']);