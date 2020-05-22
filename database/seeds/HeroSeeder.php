<?php

use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('heroes')->insert([
            'name' => 'Pudge',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Phantom Assassin',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Sniper',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Invoker',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Slark',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Legion Commander',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Axe',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Windranger',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Riki',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Lion',
        ]);
        DB::table('heroes')->insert([
            'name' => 'Mirana',
        ]);
    }
}
