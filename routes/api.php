<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::get('tareas', [TareaController::class , 'index']);
Route::get('tareas/{id}', [TareaController::class , 'show']);

Route::patch('tareas/{id}', function() {
    return 'prueba';
});
Route::put('tareas/{id}', function() {
    return 'prueba';
});
Route::post(uri: 'tareas', action: [TareaController::class , 'store']);

Route::delete('tareas/{id}',[TareaController::class , 'destroy']);