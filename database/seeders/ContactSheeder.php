<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSheeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('contacts')->insert([
            [
                'name'=> 'nguyen manh cuong',
                'email'=> 'abc@gmail.com',
                'phone'=> '098765431',
                'message'=> 'nguyen manh cuong',
                'status'=> true,
                'created_at'=> now(),
            ],
            [
                'name'=> 'nguyen manh dat',
                'email'=> 'abc123@gmail.com',
                'phone'=> '098765431',
                'message'=> 'nguyen manh dat',
                'status'=> true,
                'created_at'=> now(),
            ]
        ]);
    }
}
