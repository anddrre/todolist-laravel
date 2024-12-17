<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/halo',function(){
    return view('coba.halo');
});


route::get('/todo',[TodoController::class,'index'])->name('todo');
route::post('/todo',[TodoController::class,'store'])->name('todo.post');
route::put('/todo/{id}',[TodoController::class,'update'])->name('todo.update');
route::delete('/todo/{id}',[TodoController::class,'destroy'])->name('todo.delete');