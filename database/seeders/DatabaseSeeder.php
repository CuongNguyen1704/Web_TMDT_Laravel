<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            // những class seeder tôi muốn chạy
            // CategotySeeder::class,
            // ProductSeeders::class,
            // BannerSheedder::class,
            CustomerSeeder::class,
            // PostSeeder::class,
            // ContactSheeder::class,
            // ReviewSeeder::class,

        ]);
    }
}
