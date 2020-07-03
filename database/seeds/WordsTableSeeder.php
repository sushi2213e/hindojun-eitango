<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 20; $i++) {
        DB::table('words')->insert([
          'folder_id' => 1,
          'minifolder_id' => 1,
          'rank' => $i + 1,
          'lemma' => 'japanese',
          'japanese' => '日本語',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      }
      for ($i=0; $i < 20; $i++) {
        DB::table('words')->insert([
          'folder_id' => 1,
          'minifolder_id' => 2,
          'rank' => $i + 21,
          'lemma' => 'english',
          'japanese' => '英語',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);
      }
    }
}
