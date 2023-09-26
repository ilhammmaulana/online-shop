<?php

namespace Database\Seeders;

use Database\Seeders\CategoryProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategoryProductSeeder::class,
            ProductSeeder::class
        ]);
    }
}
