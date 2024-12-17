<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;


route::get('/halo',function(){
    return view('coba.halo');
});


route::get('/',[TodoController::class,'index'])->name('todo');
route::post('/',[TodoController::class,'store'])->name('todo.post');
route::put('/{id}',[TodoController::class,'update'])->name('todo.update');
route::delete('/{id}',[TodoController::class,'destroy'])->name('todo.delete');