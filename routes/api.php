<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::get('tareas', [TareaController::class , 'index']);
Route::get('tareas/{id}', [TareaController::class , 'show']);

Route::patch('tareas/{id}', [TareaController::class , 'edit']);

Route::put('tareas/{id}', [TareaController::class , 'update']);
Route::post(uri: 'tareas', action: [TareaController::class , 'store']);

Route::delete('tareas/{id}',[TareaController::class , 'destroy']);