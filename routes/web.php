<?php

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

Route::group(['prefix' => '/'], function () {
	Route::get('/', 'DashboardController@index');
	Route::get('filter-card/{id}', 'DashboardController@ajaxCards');
	Route::get('teste/{id_card}/{tipo}', 'CardController@movimentaCard');
	Route::get('autocomplete/professor', ['as' => 'lista.professores', 'uses' => 'ProfessorController@list']);

});

Route::group(['prefix' => '/dashboard', 'middleware' => 'auth'], function () {
	//Rotas de cadastro
	Route::get('cadastro/curso', ['as' => 'curso.cadastro', 'uses' => 'CursoController@create']);
	Route::post('cadastro/curso', ['as' => 'post.create.curso', 'uses' => 'CursoController@store']);

	//Rotas de listagem
	Route::get('lista/cursos', ['as' => 'lista.cursos', 'uses' => 'CursoController@index']);
	Route::get('lista/cards', ['as' => 'lista.cards', 'uses' => 'CardController@index']);
	Route::get('lista/professores', ['as' => 'lista.professores', 'uses' => 'ProfessorController@index']);
	
	//Rotas de cadastro
	Route::get('cadastro/professor', ['as' => 'professor.cadastro', 'uses' => 'ProfessorController@create']);
	Route::post('cadastro/professor', ['as' => 'post.create.professor', 'uses' => 'ProfessorController@store']);
	Route::get('cadastro/card/{id}/professor', ['as' => 'professor.card', 'uses' => 'CardController@viewCadastroProfessor']);
	Route::post('cadastro/card/professor', ['as' => 'post.create.professor.card', 'uses' => 'CardController@cadastroProfessor']);
	//Rotas de cadastro
	Route::get('cadastro/card', ['as' => 'cadastro.card', 'uses' => 'CardController@create']);
	Route::get('cadastro/card/{id}/material', ['uses' => 'CardController@viewCadastroMaterial']);
	Route::post('cadastro/card/material', ['as' => 'post.create.material.card', 'uses' => 'CardController@cadastroMaterial']);
	Route::post('cadastro/card', ['as' => 'post.create.card', 'uses' => 'CardController@store']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
	
});

Auth::routes();


