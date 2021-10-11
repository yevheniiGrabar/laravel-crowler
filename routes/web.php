<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemSchemaController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\WebsitesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class , 'index']);
Route::get('/article-details/{id}', [HomeController::class , 'getArticleDetails']);
Route::get('/category/{id}', [HomeController::class , 'getCategory']);

Route::group(['prefix' => 'dashboard'], function() {
    Route::resource('/websites', WebsitesController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::patch('/links/set-item-schema', [LinksController::class , 'setItemSchema']);
    Route::post('/links/scrape', [LinksController::class, 'scrape']);
    Route::resource('/links', LinksController::class);
    Route::resource('/item-schema', ItemSchemaController::class);
    Route::resource('/articles', ArticlesController::class);
});
