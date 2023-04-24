<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_library extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ["id_product"=>1,'image'=>'product-img-2.jpg'],
            ["id_product"=>2,'image'=>'product-img-4.jpg'],
            ["id_product"=>3,'image'=>'product-img-6.jpg'],
            ["id_product"=>4,'image'=>'product-img-3.jpg'],
            ["id_product"=>5,'image'=>'product-img-7.jpg'],
            ["id_product"=>6,'image'=>'product-img-8.jpg'],
            ["id_product"=>6,'image'=>'thanh-long-1.jpg'],
            ["id_product"=>6,'image'=>'thanh-long-2.jpg'],
            ["id_product"=>6,'image'=>'thanh-long-3.jpg'],
            ["id_product"=>7,'image'=>'product-img-9.jpg'],
            ["id_product"=>8,'image'=>'product-img-10.jpg'],
            ["id_product"=>9,'image'=>'product-img-1.jpg'],
            ["id_product"=>10,'image'=>'product-img-13.jpg'],
            ["id_product"=>11,'image'=>'product-img-11.jpg'],
            ["id_product"=>12,'image'=>'product-img-12.jpg'],
            ["id_product"=>13,'image'=>'product-img-16.jpg'],
            ["id_product"=>14,'image'=>'product-single-img-1.jpg'],
            ["id_product"=>15,'image'=>'product-single-img-2.jpg'],
            ["id_product"=>16,'image'=>'product-single-img-3.jpg'],
            ["id_product"=>17,'image'=>'product-single-img-4.jpg'],
        ];
        try {
            foreach($images as $img){
                DB::table('library')->insert($img);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
