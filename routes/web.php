<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// page routes
Route::get('/', function () {
    return view('/home');
});

Route::get('/grades-tracker/classes', function(){
    return view('/gt-classes');
})->name('class-view');

Route::get('/grades-tracker/classes/details/{id}', function(){
    return view('/gt-classes-details');
})->name('class-detail-view');

// api data routes for classes table
Route::get('/api/classes', ['uses' => 'GoalController@getAllClasses']);
Route::post('/api/classes', ['uses' => 'GoalController@createNewClass']);
Route::delete('/api/classes/{id}', ['uses' => 'GoalController@deleteClass']);
Route::patch('/api/classes/{id}', ['uses' => 'GoalController@updateClass']);

// api data routes sections table
Route::get('/api/classes/details/{id}', ['uses' => 'GoalController@getDetailsByID']);
Route::post('/api/classes/details/{id}', ['uses' => 'GoalController@createNewSection']);
Route::delete('/api/classes/details/{id}', ['uses' => 'GoalController@deleteSection']);
// add patch route for sections

// api data routes for assignments table
Route::post('/api/classes/details/assignments/{id}', ['uses' => 'GoalController@createNewAssignment']);
Route::delete('/api/classes/details/assignments/{id}', ['uses' => 'GoalController@deleteAssignment']);
Route::patch('/api/classes/details/assignments/{id}', ['uses' => 'GoalController@updateAssignment']);


