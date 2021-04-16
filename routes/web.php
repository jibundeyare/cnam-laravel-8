<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MarqueController;

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

// page d'accueil
// requête de type GET seulement
Route::get('/', [MainController::class, 'index']);

// page de test
// requête de type GET seulement
Route::get('/test', [MainController::class, 'test']);

// page de recherche
// requête de type GET ou POST
Route::match(['get', 'post'], '/search', [MainController::class, 'search']);

// pages CRUD de marques
// Verb 	URI 	Action 	Route Name
// GET 	/photos 	index 	photos.index
// GET 	/photos/create 	create 	photos.create
// POST 	/photos 	store 	photos.store
// GET 	/photos/{photo} 	show 	photos.show
// GET 	/photos/{photo}/edit 	edit 	photos.edit
// PUT/PATCH 	/photos/{photo} 	update 	photos.update
// DELETE 	/photos/{photo} 	destroy 	photos.destroy
Route::resource('marques', MarqueController::class);
