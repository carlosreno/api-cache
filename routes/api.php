<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\{
    CourseController
};
use \App\Http\Controllers\Api\{
    ModuleController
};

Route::apiResource('/courses/{course}/modules',ModuleController::class);
Route::get('/courses',[CourseController::class,'index']);
Route::post('/course',[CourseController::class,'store']);
Route::get('/course/{identify}',[CourseController::class,'show']);
Route::put('/course/{course}',[CourseController::class,'update']);
Route::delete('/course/{identify}',[CourseController::class,'destroy']);

Route::get('/',function(){
    return response()->json(['message'=>'ok']);
});
