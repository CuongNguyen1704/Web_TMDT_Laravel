<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
   protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'ma_san_pham'=>$this->faker->unique()->numerify('SP#####'),
            'ten_san_pham'=>$this->faker->word,
            // 'category_id'=>$this->faker->numberBetween(),
            'hinh_anh'=> null,
            'gia'=>$this->faker->randomFloat(2,1000,9999999),
            'gia_khuyen_mai'=>$this->faker->optional()->randomFloat(2,5000,9000000),
            'so_luong'=>$this->faker->numberBetween(1,200),
            'ngay_nhap'=>$this->faker->date('Y-m-d'),
            'mo_ta'=>$this->faker->sentence(),
            'trang_thai'=>$this->faker->boolean(),
        ];
    }
}
