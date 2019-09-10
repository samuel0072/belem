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
Route::resource('/answered_test', 'AnsweredTestController');
Route::resource('/school_member', 'SchoolMemberController');
Route::resource('/grade_class', 'GradeClassController');
Route::resource('/question_answered_test', 'QuestionAnsweredTestController');
