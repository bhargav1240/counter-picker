<?php

use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counters')->insert([
            'hero_id' => 1,
            'counterd_by' => 21,
            'score' => 4.36
        ]);
        DB::table('counters')->insert([
            'hero_id' => 1,
            'counterd_by' => 69,
            'score' => 3.80
        ]);
        DB::table('counters')->insert([
            'hero_id' => 1,
            'counterd_by' => 88,
            'score' => 2.83
        ]);
        DB::table('counters')->insert([
            'hero_id' => 1,
            'counterd_by' => 14,
            'score' => 2.27
        ]);
        DB::table('counters')->insert([
            'hero_id' => 1,
            'counterd_by' => 43,
            'score' => 2.10
        ]);

        //

        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 59,
            'score' => 4.87
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 38,
            'score' => 4.77
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 78,
            'score' => 3.54
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 60,
            'score' => 2.62
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 88,
            'score' => 2.52
        ]);
    }
}
