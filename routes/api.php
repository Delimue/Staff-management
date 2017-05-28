<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Making routes to the viewer, so data will be shown 

Route::resource('/v1/employees', v1\EmployeeController::class,[
        
        'except' => ['create', 'edit']      //remove create and edit functions from controller, 
                                            //since they are mainly used for HTML purposes
        ]);

Route::resource('/v1/teams', v1\TeamController::class,[
        
        'except' => ['create', 'edit']      //remove create and edit functions from controller, 
                                            //since they are mainly used for HTML purposes     
        ]);