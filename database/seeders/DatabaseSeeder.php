<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Tag;
use App\Models\Image;

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
        // User::factory(5)->create();
        // Auction::factory(20)->create();
        // Bid::factory(100)->create();
        // Tag::factory(15)->create();
        // $auctions = Auction::all();
        // $tags = Tag::all();
        // foreach ($auctions as $auction) {
        //     $tagsToAttach = $tags->random(rand(1, 15))->pluck('id')->toArray();
        //     $auction->tags()->attach($tagsToAttach);
        // }


        User::factory(5)->create();
        Category::factory(10)->create();
        $products = Product::factory(20)->create();
        $tags = Tag::factory(15)->create();
        Image::factory(100)->create();

        // $products = Product::all();
        // $tags = Tag::all();
        // $categories = Category::all();

        // Przypisz losowe tagi do aukcji
        foreach ($products as $product) {
            $tagsToAttach = $tags->random(rand(1, 15))->pluck('id')->toArray();
            $product->tags()->attach($tagsToAttach);
        }

        // // Stwórz 100 obrazów
        // $images = Image::factory(100)->create();

        // // Podziel obrazy między produkty
        // $imagesPerProduct = 5; // 100 obrazów / 20 produktów = 5 obrazów na produkt

        // $imageIndex = 0;

        // foreach ($products as $product) {
        //     // $product['category_id'] = rand(1,10);
        //     for ($i = 0; $i < $imagesPerProduct; $i++) {
        //         // Przypisz obraz do produktu
        //         $images[$imageIndex]->product_id = $product->id;
        //         $images[$imageIndex]->save();
        //         $imageIndex++;
        //     }
        // }

        // foreach ($products as $product) {
        //     $tagsToAttach = $tags->random(rand(1, 15))->pluck('id')->toArray();
        //     $product->tags()->attach($tagsToAttach);

        // }

    }
}
