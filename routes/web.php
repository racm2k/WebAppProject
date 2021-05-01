<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Models\Produtos;
use Illuminate\Http\Request;
use App\Http\Controllers\StripeController;


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

// Routes das paginas gerais
Route::get('/', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/index', [App\Http\Controllers\TestController::class, 'index']);
Route::get('/about', [App\Http\Controllers\TestController::class, 'about']);
Route::get('/team', [App\Http\Controllers\TestController::class, 'team']);
Route::get('/admin', [App\Http\Controllers\TestController::class, 'controlPanel']);

//Routes da gestão do carrinho
Route::get('/produtos/cart', [App\Http\Controllers\ProdutosController::class, 'cart']);
Route::get('/produtos/add-to-cart/{produtos}', [App\Http\Controllers\ProdutosController::class, 'addToCart']);
Route::patch('update-cart', [ProductsController::class,'updateCart']);
Route::delete('remove-from-cart', [ProductsController::class,'removeFromCart']);

// Routes dos Produtos
Route::get('/produtos', [App\Http\Controllers\ProdutosController::class, 'indexAll']);
Route::get('/produtos/crianca', [App\Http\Controllers\ProdutosController::class, 'indexCrianca']);
Route::get('/produtos/higiene', [App\Http\Controllers\ProdutosController::class, 'indexHigiene']);
Route::get('/produtos/bebidas', [App\Http\Controllers\ProdutosController::class, 'indexBebidas']);
Route::get('/produtos/eletrodomesticos', [App\Http\Controllers\ProdutosController::class, 'indexEletrodomesticos']);
Route::get('/produtos/vestuario-calcado', [App\Http\Controllers\ProdutosController::class, 'indexVestuarioCalcado']);
Route::get('/produtos/comida', [App\Http\Controllers\ProdutosController::class, 'indexComida']);
Route::get('/produtos/create', [App\Http\Controllers\ProdutosController::class, 'create']);
Route::post('/produtos', [App\Http\Controllers\ProdutosController::class, 'store']);

// Routes das Alterações dos Produtos
Route::get('/produtos/show/{produtos}', [App\Http\Controllers\ProdutosController::class, 'show']);
Route::get('/produtos/edit/{produtos}', [App\Http\Controllers\ProdutosController::class, 'edit']);
Route::post('/produtos/update/{produtos}', [App\Http\Controllers\ProdutosController::class, 'update']);
Route::post('/produtos/destroy/{produtos}', [App\Http\Controllers\ProdutosController::class, 'destroy']);

// Routes do Perfil
Route::get('/users/perfil', [App\Http\Controllers\UserController::class, 'showPerfil']);

// Routes geradas pelo stripe e pela autenticação
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/payment', [ProdutosController::class, 'paymentProcess'])->middleware('auth');

// Routes da barra de pesquisa
Route::get('/search',[ProdutosController::class,'search']);