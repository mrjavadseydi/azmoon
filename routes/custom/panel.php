<?php


Route::get('activity/{id}',[\App\Http\Controllers\ActivityController::class,"showActivity"])->name('activity.show');
