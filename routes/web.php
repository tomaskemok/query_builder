<?php

use App\Http\Controllers\AjaxGetSinonimosController;
use App\Http\Controllers\CrearProductoController;
use App\Http\Controllers\QueryController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('query', QueryController::class)->only([
        'create'
    ]);

    Route::get('/', function() {
        return redirect(config('nova.path'));
    });

    Route::post('/crear-producto', CrearProductoController::class)->name('crear_producto');
    Route::get('/obtener-sinonimos', AjaxGetSinonimosController::class)->name('obtener_sinonimos');
});

Auth::routes();
