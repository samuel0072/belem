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
Route::get('/', function() {
    return redirect('/school');
});
Route::resource('/school', 'SchoolController');
Route::resource('/answered_test', 'AnsweredTestController');
Route::resource('/schoolmember', 'SchoolMemberController');
Route::resource('/grade_class', 'GradeClassController');
Route::resource('/question', 'QuestionController');
Route::resource('/test', 'TestController');
Route::resource('/question_answered_test', 'QuestionAnsweredTestController');
Route::resource('/answered_test', 'AnsweredTestController');

Route::post('/test/{id}/correct', 'TestController@correctAnsTests');
Route::get('/test/{id}/correct', 'TestController@correct');

Route::get('/school/{id}/classes', 'SchoolController@classes');

Route::get('/question/{id}/option_count', 'QuestionController@optionCount');

Route::get('/redirect/home', function() {
    return redirect('/school');
});
