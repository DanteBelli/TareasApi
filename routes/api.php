<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('tareas', function() {
    return 'prueba';
});
Route::get('tareas/{id}', function() {
    return 'prueba';
});
Route::patch('tareas/{id}', function() {
    return 'prueba';
});
Route::post('tareas', function() {
    return 'prueba';
});
Route::delete('tareas/{id}', function() {
    return 'prueba';
});
