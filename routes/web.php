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

Route::middleware('auth')->group(function () {
    Route::resource('/school', 'SchoolController');
    Route::get('/school/{id}/classes', 'SchoolController@showClasses');
    Route::get('/school/{id}/users', 'Auth\UserController@showUsers');
    Route::post('school/{id}/users', 'Auth\UserController@setAccLevel');

    Route::resource('/answered_test', 'AnsweredTestController');

    Route::resource('/schoolmember', 'SchoolMemberController');
    Route::get('/schoolmember/{id}/ans_tests', 'SchoolMemberController@showAnsweredTests');
    Route::get('/schoolmember/{id}/test/{test_id}/topic/{topic_id}', 'SchoolMemberController@getTopicScore');
    Route::get('/schoolmember/{enroll}/findbyenroll', 'SchoolMemberController@getMemberbyEnroll');

    Route::resource('/grade_class', 'GradeClassController');
    Route::get('/grade_class/{id}/students', 'GradeClassController@showClassMembers');
    Route::get('/grade_class/{id}/tests', 'GradeClassController@showTests');

    Route::resource('/question', 'QuestionController');
    Route::get('/question/{id}/option_count', 'QuestionController@optionCount');

    Route::resource('/test', 'TestController');
    Route::post('/test/{id}/correct', 'TestController@correctAnsTests');
    Route::get('/test/{id}/students', 'TestController@showStudents');
    Route::get('/test/{id}/answers', 'TestController@showAnswers');
    Route::get('/test/{test_id}/countdesc/{topic_id}', 'TestController@topicCount');
    Route::get('/test/{id}/scorecount', 'TestController@scoreCount');

    Route::resource('/question_answered_test', 'QuestionAnsweredTestController');

    Route::resource('/answered_test', 'AnsweredTestController');


    Route::get('/topic', 'TopicController@index');

    Route::get('/', function() {
        return redirect('/school');
    });
});

Auth::routes();




