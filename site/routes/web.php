<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something terrible!
|
*/

Route::resource('/school', 'SchoolController');
Route::get('/school/{id}/classes', 'SchoolController@showClasses');
Route::get('/school_all','SchoolController@showAll' );

Route::resource('/answered_test', 'AnsweredTestController');

Route::resource('/schoolmember', 'SchoolMemberController');
Route::get('/schoolmember/{id}/ans_tests', 'SchoolMemberController@showAnsweredTests');

Route::resource('/grade_class', 'GradeClassController');
Route::get('/grade_class/{id}/students', 'GradeClassController@showClassMembers');

Route::resource('/question', 'QuestionController');
Route::get('/question/{id}/option_count', 'QuestionController@optionCount');

Route::resource('/test', 'TestController');
Route::post('/test/{id}/correct', 'TestController@correctAnsTests');
Route::get('/test/{id}/correct', 'TestController@correct');

Route::resource('/question_answered_test', 'QuestionAnsweredTestController');

Route::resource('/answered_test', 'AnsweredTestController');


Route::get('/', function() {
    return redirect('/school_all');
});

