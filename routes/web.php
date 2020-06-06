<?php

use App\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function(){
    return view('welcome');
});

Route::get('/home', function(){
    return view('home');
});

Route::get('/heroes', 'HeroController@getAllHeroes');



Route::view('/get_all_heroes_view', 'all_heroes');
Route::get('/get_all_heroes_details', 'HeroController@getAllHeroes');

Route::post('/get_counters_for_selected_hero', 'CounterController@getCounterForSelectedHero2');
Route::post('/save_counters_for_selected_hero', 'CounterController@saveCounterForSelectedHero');

Route::post('/on_select_hero', 'CounterController@getCounterForSelectedHero');