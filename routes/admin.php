<?php

use App\Http\Controllers\admin\PagesController;


Route::get('/admin',[PagesController::class,'index'])->name('admin.index');




?>
