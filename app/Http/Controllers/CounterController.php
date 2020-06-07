<?php

namespace App\Http\Controllers;

use App\Counter;
use App\Hero;
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
        $id = $request->data['id'];
        $data= DB::table('counters')
            ->leftJoin('heroes', 'counters.counterd_by', '=', 'heroes.id')
            ->select(
                'counters.*',
                'heroes.name',
            )
            ->where('counters.hero_id', $id)
            ->orderBy('counters.score', 'desc')
            ->get();

        return $data;
    }
    public function saveCounterForSelectedHero(Request $request){
        foreach ($request->data as $d) {
            if(isset($d['id'])){
                $counter_hero = Counter::where('id', $d['id'])->first();
            }else{
                $counter_hero = new Counter();
            }

            $counter_hero->hero_id = $d['hero_id'];
            $counter_hero->counterd_by = $d['counterd_by'];
            $counter_hero->score = 1;

            $counter_hero->save();
        }

        $hero = Hero::where('id', $counter_hero->hero_id)->first();

        return $this->getCounterForSelectedHero2(new Request (['data' => $hero]));
    }

    public function deleteCounterForSelectedHero(Request $request){
        
        $id = $request->data['id'];

        $counter_hero = Counter::where('id', $id)->first();

        $counter_hero->delete();

        $hero = Hero::where('id', $counter_hero->hero_id)->first();

        return $this->getCounterForSelectedHero2(new Request (['data' => $hero]));
    }
}
