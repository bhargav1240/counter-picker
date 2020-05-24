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

Route::get('/heroes', function(){
    $data = Hero::all();
    
    return $data;
});

Route::post('/on_select_hero', function (Request $request) {
    
    $data = DB::table('counters')
    ->leftJoin('heroes', 'counters.counterd_by', '=', 'heroes.id')
    ->select(
        'counters.*',
        'heroes.name'
    )
    ->where('counters.hero_id', '=', $request->data)
    ->orderBy('counters.score', 'desc')
    ->get();

    return $data;
});

Route::get('/{id}', function ($id) {

    $counters = DB::table('counters')
    ->leftJoin('heroes', 'counters.counterd_by', '=', 'heroes.id')
    ->select(
        'counters.*',
        'heroes.name'
    )
    ->where('counters.hero_id', '=', $id)
    ->orderBy('counters.score', 'desc')
    ->get();
    
    return $counters;
});
