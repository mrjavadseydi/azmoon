<?php
use Illuminate\Support\Facades\Route;


Route::get('/auth',[\App\Http\Controllers\AuthController::class,'form']);
Route::post('/auth',[\App\Http\Controllers\AuthController::class,'login'])->name('auth');
Route::post('/auth/signup',[\App\Http\Controllers\AuthController::class,'signup'])->name('signup');
Route::put('/auth/signup',[\App\Http\Controllers\AuthController::class,'active']);
Route::get('/auth/signup',[\App\Http\Controllers\AuthController::class,'signupget']);
Route::post('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');
