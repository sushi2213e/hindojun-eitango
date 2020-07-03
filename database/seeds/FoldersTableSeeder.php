<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) {
          DB::table('folders')->insert([
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
