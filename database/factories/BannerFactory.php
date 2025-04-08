<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
{
    protected $model = Banner::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title'=>$this->faker->sentence(), // cụm từ ngẫu nhiên
            'description'=>$this->faker->sentence,  // cụm từ ngẫu nhiên còn world là 1 từ
            'status'=>$this->faker->randomElement([0,1]) // trạng thái ngẫu nhiên 0 hoặc 1
        ];
    }
}
