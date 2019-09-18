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
/*
 * /test/{id}/answers
 * /answered_tests/{test_id}
 * */
Route::middleware('auth')->group(function () {
    Route::resource('/school', 'SchoolController');
    Route::get('/school/{id}/classes', 'SchoolController@showClasses');

    Route::resource('/answered_test', 'AnsweredTestController');

    Route::resource('/schoolmember', 'SchoolMemberController');
    Route::get('/schoolmember/{id}/ans_tests', 'SchoolMemberController@showAnsweredTests');

    Route::resource('/grade_class', 'GradeClassController');
    Route::get('/grade_class/{id}/students', 'GradeClassController@showClassMembers');
    Route::get('/grade_class/{id}/tests', 'GradeClassController@showTests');

    Route::resource('/question', 'QuestionController');
    Route::get('/question/{id}/option_count', 'QuestionController@optionCount');

    Route::resource('/test', 'TestController');
    Route::post('/test/{id}/correct', 'TestController@correctAnsTests');
    Route::get('/test/{id}/correct', 'TestController@correct');
    Route::get('/test/{id}/students', 'TestController@showStudents');
    Route::get('/test/{id}/answers', 'TestController@showAnswers');

    Route::resource('/question_answered_test', 'QuestionAnsweredTestController');

    Route::resource('/answered_test', 'AnsweredTestController');


    Route::get('/', function() {
        return redirect('/school');
    });



    Route::get('/testing', function() {
        return view("testing.test");
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


