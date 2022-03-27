<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LearnerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/dashboard", function () {
    return view("dashboard");
})
    ->middleware(["auth"])
    ->name("dashboard");

Route::get("/learners", [LearnerController::class, "index"])
    ->middleware(["auth"])
    ->name("learners.index");

Route::post("/learners", [LearnerController::class, "store"])
    ->middleware(["auth"])
    ->name("learners.store");

Route::get("/courses", [CourseController::class, "index"])
    ->middleware(["auth"])
    ->name("courses.index");

Route::post("/courses", [CourseController::class, "store"])
    ->middleware(["auth"])
    ->name("courses.store");

Route::get("/courses/{course}", [CourseController::class, "show"])
    ->middleware(["auth"])
    ->name("courses.show");

Route::post("/courses/{course}", [CourseController::class, "addLearner"])
    ->middleware(["auth"])
    ->name("courses.addLearner");

Route::get("/courses/{course}/register", [CourseController::class, "register"])
    ->middleware(["auth"])
    ->name("courses.register");

Route::post("/courses/{course}/register", [
    CourseController::class,
    "storeRegister",
])
    ->middleware(["auth"])
    ->name("courses.storeRegister");

require __DIR__ . "/auth.php";
