<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Basic Photography Package',
                'description' => '2-hour photo session with 20 edited digital images',
                'price' => 299.99,
                'stock_quantity' => 999,
                'sku' => 'PHOTO-BASIC-001',
                'category' => 'Photography',
                'status' => 'active',
            ],
            [
                'name' => 'Premium Photography Package',
                'description' => '4-hour photo session with 40 edited digital images and 5 printed photos',
                'price' => 499.99,
                'stock_quantity' => 999,
                'sku' => 'PHOTO-PREMIUM-001',
                'category' => 'Photography',
                'status' => 'active',
            ],
            [
                'name' => 'Basic Video Package',
                'description' => '2-hour video shoot with basic editing',
                'price' => 399.99,
                'stock_quantity' => 999,
                'sku' => 'VIDEO-BASIC-001',
                'category' => 'Videography',
                'status' => 'active',
            ],
            [
                'name' => 'Premium Video Package',
                'description' => '4-hour video shoot with advanced editing and color grading',
                'price' => 799.99,
                'stock_quantity' => 999,
                'sku' => 'VIDEO-PREMIUM-001',
                'category' => 'Videography',
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 