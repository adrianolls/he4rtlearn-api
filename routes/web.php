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
$router->get('users/{id}','User\\UserController@show');
$router->delete('users/{id}','User\\UserController@destroy');

$router->get('sections', 'Section\\SectionController@index');
$router->post('sections', 'Section\\SectionController@store');
$router->get('sections/{id}', 'Section\\SectionController@show');
$router->put('sections/{id}', 'Section\\SectionController@update');
$router->delete('sections/{id}', 'Section\\SectionController@destroy');

$router->get('sections/{id}/lessons', 'Lesson\\LessonController@index');
$router->post('sections/{id}/lessons', 'Lesson\\LessonController@store');
$router->get('sections/{id}/lessons/{lesson_id}', 'Lesson\\LessonController@getLesson');
$router->put('sections/{id}/lessons/{lesson_id}', 'Lesson\\LessonController@updateLesson');
$router->delete('sections/{id}/lessons/{lesson_id}', 'Lesson\\LessonController@destroyLesson');