<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    public function definition(): array
    {
        // Sprawdź, czy istnieją produkty w bazie danych
        $productIds = Product::all()->pluck('id')->toArray();

        return [
            // Wybierz losowe ID istniejącego produktu
            'product_id' => $this->faker->randomElement($productIds),
            'url' => $this->faker->imageUrl,
        ];
    }
}
