<?php

namespace App\Http\Controllers;

use App\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCounterForSelectedHero(Request $request)
    {
        $selectedHeroes = [];
        foreach($request->data as $data){
            array_push($selectedHeroes, $data['id']);
        }
            
        $data= DB::table('counters')
            ->leftJoin('heroes', 'counters.counterd_by', '=', 'heroes.id')
            ->select(
                'counters.*',
                'heroes.name',
            )
            ->whereIn('counters.hero_id', $selectedHeroes)
            ->orderBy('counters.score', 'desc')
            ->get();
            
            $result = $data->groupBy('name')->toArray();
            
            $t=0;
            
            foreach ($result as $key => $value) {
                if(count($value)>1){
                    foreach ($value as $key => $v) {
                        $t += $v->score;
                    }
                    $value[0]->score = $t;
                    $t=0;
                }
                $value[0]->count = count($value);
            }

            $newArray = [];

            $array = array_values($result);

            foreach ($array as $key => $value) {
                array_push($newArray,$value[0]);
            }

        return $newArray;
    }

    public function getCounterForSelectedHero2(Request $request){
        $data= DB::table('counters')
            ->leftJoin('heroes', 'counters.counterd_by', '=', 'heroes.id')
            ->select(
                'counters.*',
                'heroes.name',
            )
            ->where('counters.hero_id', $request->data)
            ->orderBy('counters.score', 'desc')
            ->get();

        return $data;
    }
    public function saveCounterForSelectedHero(Request $request){
        dd($request);
    }
}
