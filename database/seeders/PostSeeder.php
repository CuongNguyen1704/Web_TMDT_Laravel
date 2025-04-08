<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('posts')->insert([
            [
              'title'=> 'Nguyen Manh Cuong1233',
              'slug'=> 'san-pham-123',
              'content'=> '0985673',
              'author_id'=> 1,
              'created_at'=> now(),
            ],
            [
              'title'=> 'Nguyen Manh Huy',
              'slug'=> 'san-pham-ok-ok',
              'content'=> '0347985622',
              'author_id'=> 1,
              'created_at'=> now(),
            ]
          ]);
    }
}
