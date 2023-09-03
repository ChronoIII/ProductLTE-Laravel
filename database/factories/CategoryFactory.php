<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoryModel;

class CategoryFactory extends Factory
{
    protected $model = CategoryModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name(),
        ];
    }

    public function name(string $sName) {
        return $this->state([
            'name'  => $sName,
        ]);
    }
}
