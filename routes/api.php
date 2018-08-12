<?php

use Illuminate\Http\Request;

Route::post('jobs/create', 'ApiController@storeJob')->name('jobs.create');

Route::get('city', 'ApiController@city')->name('city');

Route::get('categories', 'ApiController@categories')->name('categories');

Route::get('execution_dates', 'ApiController@executionDates')->name('execution_dates');