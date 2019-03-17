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

$router->get('/', function () use ($router) {
    return response("Servidor online!");
});

$router->post('auth/login','AuthController@loginPortal');
$router->post('admin/auth/login','AuthController@loginAdmin');
$router->post('auth/refresh','AuthController@refresh');
$router->post('auth/logout','AuthController@logout');
$router->post('auth/forgot', 'AuthController@forgot');
$router->post('auth/checkToken', 'AuthController@checkToken');
$router->post('auth/reset/{token}', 'AuthController@reset');

$router->get('users','User\\UserController@index');
$router->post('users','User\\UserController@store');
$router->get('users/me','User\\MeController@me');
$router->put('users/me','User\\MeController@update');
$router->put('users/me/change', 'User\\MeController@change');

$router->get('users/{id}','User\\UserController@show');
$router->delete('users/{id}','User\\UserController@destroy');

$router->get('sections', 'Section\\SectionController@index');
$router->post('sections', 'Section\\SectionController@store');
$router->get('sections/{section_id}', 'Section\\SectionController@show');
$router->put('sections/{section_id}', 'Section\\SectionController@update');
$router->delete('sections/{section_id}', 'Section\\SectionController@destroy');

$router->get('sections/{section_id}/lessons', 'Lesson\\LessonController@getLessons');
$router->post('sections/{section_id}/lessons', 'Lesson\\LessonController@postLesson');
$router->get('sections/{section_id}/lessons/{lesson_id}', 'Lesson\\LessonController@getLesson');
$router->put('sections/{section_id}/lessons/{lesson_id}', 'Lesson\\LessonController@putLesson');
$router->delete('sections/{section_id}/lessons/{lesson_id}', 'Lesson\\LessonController@deleteLesson');

$router->get('sections/{section_id}/lessons/{lesson_id}/challenges', 'Challenge\\ChallengeController@getChallenges');
$router->post('sections/{section_id}/lessons/{lesson_id}/challenges', 'Challenge\\ChallengeController@postChallenge');
$router->get('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}', 'Challenge\\ChallengeController@getChallenge');
$router->put('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}', 'Challenge\\ChallengeController@putChallenge');
$router->delete('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}', 'Challenge\\ChallengeController@deleteChallenge');


$router->get('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}/answers', 'Challenge\\AnswersController@getAnswers');
$router->post('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}/answers', 'Challenge\\AnswersController@postAnswer');
$router->get('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}/answers/{answer_id}', 'Challenge\\AnswersController@getAnswer');
$router->put('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}/answers/{answer_id}', 'Challenge\\AnswersController@putAnswer');
$router->delete('sections/{section_id}/lessons/{lesson_id}/challenges/{challenge_id}/answers/{answer_id}', 'Challenge\\AnswersController@deleteAnswer');