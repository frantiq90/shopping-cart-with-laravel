<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 9; $i++) {
        $product = new \App\Product([
            'imagePath' => 'https://www.sorbet.co.za/wp-content/uploads/2016/02/bathandbody_300x300-1.jpg',
            'title' => 'Product nr - ' .$i. 'Hand Cream 120ml',
            'description' => 'Super dry hand cream with small glass pieces for good fresh feelings.',
            'price' => rand(20, 200)
        ]);

        $product->save();
        }



    }
}
