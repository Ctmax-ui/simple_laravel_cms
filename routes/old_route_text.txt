<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;



Route::get('/', [IndexController::class, "index"]);
Route::get('/about', [IndexController::class, "about"]);

// Route::get('/contact/{id}', [IndexController::class, "contact"]);
Route::get('/contact', function(){
return view("contact");
});


// this is called group route.
Route::prefix("books")->group(function () {
    Route::get("/", function () {
        return "this is books page";
    });

    Route::get("/b1", function () {
        return "this is book pages sub branch";
    });
});


// the post method to send the data value
Route::post('/contact', function(Request $request){
    dd($request->username);
})->name("name.post");

//for creating account page redeiraction.
Route::resource("users", UserController::class);