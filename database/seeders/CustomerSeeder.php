<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table('customers')->insert([
        //     [
        //         'author_id' => 1,
        //         'name' => 'Nguyen Manh Cuong1233',
        //         'email' => 'nmc@gmail.com',
        //         'phone' => '0985673',
        //         'address' => 'Tuyen Quang',
        //         'password' => bcrypt('abc123'),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'author_id' => 2,
        //         'name' => 'Nguyen Manh Dung',
        //         'email' => 'nmd123@gmail.com',
        //         'phone' => '09856745',
        //         'address' => 'Tuyen Quang2',
        //         'password' => bcrypt('abc123@'),
        //         'created_at' => now(),
        //     ],
        // ]);

        Customer::factory(5)->create();
        
    }
}
