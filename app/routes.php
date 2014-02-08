<?php

Route::get('/', 'App\Controller\Item@index');
Route::get('/create', ['as' => 'item-create', 'uses' => 'App\Controller\Item@create']);
Route::post('/', ['as' => 'item-store', 'uses' => 'App\Controller\Item@store']);
Route::get('/{slug}', ['as' => 'item-show', 'uses' => 'App\Controller\Item@show']);
Route::get('/{slug}/edit', ['as' => 'item-edit', 'uses' => 'App\Controller\Item@edit']);
