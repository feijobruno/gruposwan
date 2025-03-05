<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Product::where('product', 'RIANOX MD-697')->first()){
            Product::create([
                'product' => 'RIANOX MD-697',
                'supplier_id' => 1,
            ]);
        }
        
        if(!Product::where('product', 'RIANOX 1010')->first()){
            Product::create([
                'product' => 'RIANOX 1010',
                'supplier_id' => 1,
            ]);
        }

        if(!Product::where('product', 'RIANOX MD-1024')->first()){
            Product::create([
                'product' => 'RIANOX MD-1024',
                'supplier_id' => 1,
            ]);
        }

        if(!Product::where('product', 'RIANOX UV-326')->first()){
            Product::create([
                'product' => 'RIANOX UV-326',
                'supplier_id' => 1,
            ]);
        }

        if(!Product::where('product', 'FLAME RETARDANT FR4150')->first()){
            Product::create([
                'product' => 'FLAME RETARDANT FR4150',
                'supplier_id' => 2,
            ]);
        }

        if(!Product::where('product', 'FLAME RETARDANT FR4250')->first()){
            Product::create([
                'product' => 'FLAME RETARDANT FR4250',
                'supplier_id' => 2,
            ]);
        }

    }
}
