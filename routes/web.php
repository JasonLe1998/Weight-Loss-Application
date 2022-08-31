<?php

use App\Http\Controllers\CrudsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutsController;
use App\Http\Controllers\CommunitiesController;

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

// any extra methods added to the controller will need to be defined in the route before the Route::resources for each controller
//main pages routes
Route::get('/', [PagesController::class, 'index']);

Route::get('/about', [PagesController::class, 'about']);

Route::get('/exercise', [PagesController::class, 'exercise']);

Route::get('/workout', [PagesController::class, 'workout']);

//Route::get('/report', [PagesController::class, 'report']);

Route::get('/community', [PagesController::class, 'community']);

Route::get('/login', [PagesController::class, 'login']);

//report pages routes
Route::get('/report/createW', [CrudsController::class, 'createW']);

Route::post('/report/storeW', [CrudsController::class, 'storeW']);

Route::delete('/report/destroyW/{id}', [CrudsController::class, 'destroyW']);

Route::get('/report/createH', [CrudsController::class, 'createH']);

Route::get('/report/{id}/createTrack', [CrudsController::class, 'createTrack']);

Route::post('/report/storeH', [CrudsController::class, 'storeHSolo']);

Route::put('/report/storeH/{id}', [CrudsController::class, 'storeH']);

Route::get('/report/showH/{id}', [CrudsController::class, 'showH']);

Route::delete('/report/destroyH/{id}', [CrudsController::class, 'destroyH']);

Route::resources([
    'report' => CrudsController::class,
]);

//exercise pages routes
Route::get("/exercise/all", [ExerciseController::class, "all"]);
Route::get("/exercise/reports", [ExerciseController::class, "reports"]);
Route::get("/exercise/all/create", [ExerciseController::class, "createExercise"]);
Route::get("/exercise/reports/createPopular", [ExerciseController::class, "createPopular"]);
Route::post('/workout/storePopular', [ExerciseController::class, 'storePopular']);
Route::get("/exercise/search", [ExerciseController::class, "search"]);
Route::put("/exercise/search/rating{id}", [ExerciseController::class, "rating"]);

Route::resources([
    'exercise' => ExerciseController::class,
]);

//workout pages routes
Route::get("workout/{id}/search", [WorkoutsController::class, "search"]);
Route::get('/workout/{workoutID}/createExercise/{exerciseID}', [WorkoutsController::class, 'createExercise']);
Route::post('/workout/storeExercise', [WorkoutsController::class, 'storeExercise']);
Route::delete('/workout/destroyExercise/{id}', [WorkoutsController::class, 'destroyExercise']);
Route::resources([
    'workout' => WorkoutsController::class,
]);

//coummunity pages routes
Route::delete('/report/destroyReply/{id}', [CommunitiesController::class, 'destroyReply']);
Route::get('/community/{id}/createR', [CommunitiesController::class, 'createR']);
Route::post('/community/storeR', [CommunitiesController::class, 'storeR']);
Route::resources([
    'community' => CommunitiesController::class,
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

