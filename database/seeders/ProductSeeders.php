<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Nơi để thêm dữ liệu vào
        // DB::table('products')->insert([
        //     [
        //         'ma_san_pham'=>'SP001',
        //         'ten_san_pham'=>'ao',
        //         'category_id'=>1,
        //         'gia'=>12000,
        //         'gia_khuyen_mai'=>10000,
        //         'so-luong'=>30,
        //         'ngay_nhap'=>'2023-03-15',
        //         'mo_ta'=>'áo khoác ấm',
        //         'trang_thai'=>true,
        //         'created_at'=>now(),

        //     ],
        //     [
        //         'ma_san_pham'=>'SP002',
        //         'ten_san_pham'=>'ao2',
        //         'category_id'=>1,
        //         'gia'=>13000,
        //         'gia_khuyen_mai'=>11000,
        //         'so-luong'=>30,
        //         'ngay_nhap'=>'2023-03-15',
        //         'mo_ta'=>'áo khoác ấm',
        //         'trang_thai'=>true,
        //         'created_at'=>now(),
        //     ]
        // ]);

        Category::factory()->count(5)->create()->each(function ($category){
            Product::factory()->count(10)->create(['category_id'=>$category->id]);
        });
    }
}
