<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(
            [insert_user::class,
            insert_typeproduct::class,
            insert_product::class,
            insert_coupon::class,
            insert_comment::class,
            insert_order::class,
            banner::class,
            insert_slide::class,
            insert_cart::class,
            insert_news::class,
            insert_library::class,
            insert_address::class,
        ]);
    }
}
