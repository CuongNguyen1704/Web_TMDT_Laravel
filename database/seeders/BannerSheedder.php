<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSheedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table('banners')->insert([
        //     [
        //         'title'=>'banner1',
        //         'description'=>'banner1 hhihi',
        //         'status'=>true,
        //     ],
        //     [
        //         'title'=>'banner2',
        //         'description'=>'banner2 hhihi',
        //         'status'=>true,
        //     ]
        // ]);

        Banner::factory(10)->create();// tạo 10 danh mục ảo
    }
}
