<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\{
    CourseController
};
Route::get('/courses',[CourseController::class,'index']);
Route::post('/course',[CourseController::class,'store']);

Route::get('/',function(){
    return response()->json(['message'=>'ok']);
});
