<?php

use Illuminate\Database\Seeder;

class PinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pins')->insert([
            'email' => 'udoinu@yahoo.com',
            'pin' => '5643',
            'used' => false,
        ]);
        
        DB::table('pins')->insert([
            'email' => 'udo@gmail.com',
            'pin' => '4532',
            'used' => false,
        ]);
    }
}
