<?php

namespace Database\Seeders;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\Picsum;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        $imageFaker = new ImageFaker(new Picsum());

        foreach(range(1, 50) as $item){

            $unic = unic(10);

            // Fetch image payload from the URL and save it
            $imageUrl = $imageFaker->image();
            Storage::put($unic . '.jpg', file_get_contents($imageUrl));

            $insert[] = [
                'product_nama' => fake()->name(),
                'product_sku' => fake()->uuid(),
                'product_barcode' => fake()->uuid(),
                'product_id_category' => fake()->numberBetween(1, 10),
                'product_description' => fake()->text(),
                'product_satuan' => fake()->name(),
                'product_harga' => fake()->numberBetween(1000, 10000),
                'product_image' => $unic,
            ];

        }

        Product::insert($insert);
    }
}
