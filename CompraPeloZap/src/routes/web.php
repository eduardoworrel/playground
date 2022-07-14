<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'PedidoController@loja');
Route::get('/categoria', 'CategoriaProdutosController@index')->name('categoria')->middleware(['auth','check.logist']);
Route::post('/categoria', 'CategoriaProdutosController@create')->name('createCategoria')->middleware(['auth','check.logist']);
Route::post('/categoria/edit', 'CategoriaProdutosController@edit')->name('editCategoria')->middleware(['auth','check.logist']);
Route::post('/categoria/delete', 'CategoriaProdutosController@delete')->name('deleteCategoria')->middleware(['auth','check.logist']);

Route::get('/formaPagamento', 'FormaPagamentoController@index')->name('formaPagamento')->middleware(['auth','check.logist']);
Route::post('/formaPagamento', 'FormaPagamentoController@create')->name('createFormaPagamento')->middleware(['auth','check.logist']);
Route::post('/formaPagamento/edit', 'FormaPagamentoController@edit')->name('editFormaPagamento')->middleware(['auth','check.logist']);
Route::post('/formaPagamento/delete', 'FormaPagamentoController@delete')->name('deleteFormaPagamento')->middleware(['auth','check.logist']);


Route::get('/formaEntrega', 'FormaEntregaController@index')->name('formaEntrega')->middleware(['auth','check.logist']);
Route::post('/formaEntrega', 'FormaEntregaController@create')->name('createFormaEntrega')->middleware(['auth','check.logist']);
Route::post('/formaEntrega/edit', 'FormaEntregaController@edit')->name('editFormaEntrega')->middleware(['auth','check.logist']);
Route::post('/formaEntrega/delete', 'FormaEntregaController@delete')->name('deleteFormaEntrega')->middleware(['auth','check.logist']);

Route::get('/cupom', 'CupomController@index')->name('cupom')->middleware(['auth','check.logist']);
Route::post('/cupom', 'CupomController@create')->name('createCupom')->middleware(['auth','check.logist']);
Route::post('/cupom/edit', 'CupomController@edit')->name('editCupom')->middleware(['auth','check.logist']);
Route::post('/cupom/delete', 'CupomController@delete')->name('deleteCupom')->middleware(['auth','check.logist']);


Route::get('/produto', 'ProdutoController@index')->name('produto')->middleware(['auth','check.logist']);
Route::post('/produto', 'ProdutoController@create')->name('createProduto')->middleware(['auth','check.logist']);
Route::post('/produto/edit', 'ProdutoController@edit')->name('editProduto')->middleware(['auth','check.logist']);
Route::post('/produto/delete', 'ProdutoController@delete')->name('deleteProduto')->middleware(['auth','check.logist']);
Route::post('/produto/{id}/ativo', 'ProdutoController@switchActive')->name('switchActive')->middleware(['auth','check.logist']);
Route::post('/produto/{id}/promocao', 'ProdutoController@switchPromocao')->name('switchPromocao')->middleware(['auth','check.logist']);
Route::post('/produto/{id}/mais_vendidos', 'ProdutoController@switchVendidos')->name('switchVendido')->middleware(['auth','check.logist']);

Route::get('/pedido', 'PedidoController@index')->name('pedido');
Route::get('/updateStatusPedido/{id}/{data}', 'PedidoController@updateStatus')->name('updateStatusPedido');
Route::get('/checkWhatsapp/{whatsapp}', 'PedidoController@checkWhatsapp');
Route::post('/pedido', 'PedidoController@create')->name('createPedido');
Route::post('/pedido/{loja}/edit', 'PedidoController@edit')->name('editPedido');
Route::post('/pedido/{loja}/delete', 'PedidoController@delete')->name('deletePedido');

Route::get('/personalizacaoLoja', 'PersonalizacaoLojaController@index')->name('personalizacaoLoja')->middleware(['auth','check.logist']);
Route::put('/personalizacaoLoja/{id}', 'PersonalizacaoLojaController@update')->name('personalizacaoUpdate')->middleware(['auth','check.logist']);


Route::get('/registerCli', 'ClienteController@index')->name('listCliente')->middleware(['auth','check.client']);
Route::post('/registerCli', 'ClienteController@create')->name('createCliente');
Route::get('/registerCli/{id}/edit', 'ClienteController@edit')->name('editClient');
Route::put('/registerCli/{id}', 'ClienteController@update')->name('updateCliente');
Route::delete('/registerCli/{id}/delete', 'ClienteController@delete')->name('deleteCliente');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth','check.logist']);
Route::get('/estadoDaLoja/{i}', 'HomeController@estadoDaLoja')->middleware(['auth','check.logist']);
