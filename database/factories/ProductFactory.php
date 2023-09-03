<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'   => CategoryModel::factory(),
            'name'          => $this->faker->name(),
            'description'   => $this->faker->text(),
            'date_time'     => now(),
        ];
    }
}
