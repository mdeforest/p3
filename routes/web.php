<?php

Route::get('/', 'ResumeController@index');
Route::get('/resume', 'ResumeController@displayResume');
Route::post('/create-resume', 'ResumeController@createResume');