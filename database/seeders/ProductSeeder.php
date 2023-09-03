<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\ProductFactory;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aCategories = [
            ['name' => 'clothing'],
            ['name' => 'tools'],
            ['name' => 'arts'],
            ['name' => 'gadgets'],
            ['name' => 'accessories'],
            ['name' => 'foods'],
        ];

        foreach ($aCategories as $oCategory) {
            try {
                ProductModel::factory()
                    ->for(CategoryModel::factory()->name($oCategory['name']), 'category')
                    ->count(10)
                    ->create();
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
    }
}
