<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Damaris',
            'last_name' => 'Ramallo',
            'document_type' => 1,
            'document_number' => '45214879',
            'email' => 'damarisramallo@ejemplo.com',
            'phone' => '1234567890',
            'password' => bcrypt('12345678'),
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);

        Product::factory(1000)->create();
    }
}
