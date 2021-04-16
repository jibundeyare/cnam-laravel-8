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

// pages CRUD pour la ressource marques
//
// voici les routes qui sont automatiquement créés :
// méthode      URI                     fonction    nom de la route
// GET          /marques                index       marques.index
// GET          /marques/create         create      marques.create
// POST         /marques                store       marques.store
// GET          /marques/{marque}       show        marques.show
// GET          /marques/{marque}/edit  edit        marques.edit
// PUT/PATCH    /marques/{marque}       update      marques.update
// DELETE       /marques/{marque}       destroy     marques.destroy
//
// {marque} désigne un emplacement dans l'URL qui doit être remplacé par l'id d'une marque stockée en BDD
Route::resource('marques', MarqueController::class);
