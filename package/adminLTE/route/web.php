<?php

Route::prefix('admin')->middleware(['web','auth'])->group(function (){
    Route::get('/', [\MrjavadSeydi\AdminLTE\http\controller\PanelController::class,'index'])->name('adminPanel');
    Route::resource('/user',\MrjavadSeydi\AdminLTE\http\controller\UserController::class);
    Route::resource('permissions', \MrjavadSeydi\AdminLTE\http\controller\PermissionController::class);
    Route::resource('roles', \MrjavadSeydi\AdminLTE\http\controller\RoleController::class);
    Route::get('/user/{id}/permission',[\MrjavadSeydi\AdminLTE\http\controller\UserController::class,'permissionList'])->name('user.permission');
    Route::post('/user/permission',[\MrjavadSeydi\AdminLTE\http\controller\UserController::class,'permissionStore'])->name('user.permission.store');

});
