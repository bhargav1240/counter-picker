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
            'hero_id' => 2,
            'counterd_by' => 7,
            'score' => 1.17
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 1,
            'score' => 1.15
        ]);
        DB::table('counters')->insert([
            'hero_id' => 2,
            'counterd_by' => 8,
            'score' => 0.60
        ]);
    }
}
