<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['id_type'=>1,'name'=>"potato",'quantity'=>2000,'description'=>"Delicius Potatoes",'original_price'=>15,'price'=>18,'sale'=>10,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','29/03/2023 00:00:00')],
            ['id_type'=>1,'name'=>"tomato",'quantity'=>2400,'description'=>"Delicius Tomatoes",'original_price'=>10,'price'=>13,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"bell pepper",'quantity'=>140,'description'=>"Delicius Bell Pepper",'original_price'=>15,'price'=>20,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','01/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"sweet potato",'quantity'=>3040,'description'=>"Delicius Sweet Potato",'original_price'=>6,'price'=>13,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/04/2023 00:00:00')],
            ['id_type'=>2,'name'=>"orange",'quantity'=>4050,'description'=>"Delicius Orange",'original_price'=>13,'price'=>19,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','11/04/2023 00:00:00')],
            ['id_type'=>2,'name'=>"dragon fruit",'quantity'=>2400,'description'=>"Delicius Dragon Fruit",'original_price'=>22,'price'=>34,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ['id_type'=>2,'name'=>"papaya",'quantity'=>290,'description'=>"Delicius Papaya",'original_price'=>10,'price'=>15,'sale'=>10,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/03/2023 00:00:00')],
            ['id_type'=>2,'name'=>"banana",'quantity'=>1200,'description'=>"Delicius Banana",'original_price'=>10,'price'=>15,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','02/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"cabbage",'quantity'=>100,'description'=>"Delicius Cabbage",'original_price'=>9,'price'=>16,'sale'=>10,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','21/03/2023 00:00:00')],
            ['id_type'=>1,'name'=>"spinach",'quantity'=>300,'description'=>"Delicius Spinach",'original_price'=>9,'price'=>15,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ['id_type'=>2,'name'=>"apple",'quantity'=>2000,'description'=>"Delicius Apple",'original_price'=>23,'price'=>32,'sale'=>10,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','11/03/2023 00:00:00')],
            ['id_type'=>2,'name'=>"kiwi",'quantity'=>2000,'description'=>"Delicius Kiwi",'original_price'=>43,'price'=>54,'sale'=>10,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','11/04/2023 00:00:00')],
            ['id_type'=>2,'name'=>"pineapple",'quantity'=>2200,'description'=>"Delicius Pineapple",'original_price'=>22,'price'=>25,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','04/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"bean sprouts",'quantity'=>200,'description'=>"Delicius Bean sprouts",'original_price'=>4,'price'=>9,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"amaranth",'quantity'=>300,'description'=>"Delicius Amaranth",'original_price'=>6,'price'=>12,'sale'=>0,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/04/2023 00:00:00')],
            ['id_type'=>1,'name'=>"centella",'quantity'=>100,'description'=>"Delicius Centella",'original_price'=>9,'price'=>15,'sale'=>20,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/03/2023 00:00:00')],
            ['id_type'=>1,'name'=>"corn",'quantity'=>3000,'description'=>"Delicius Corn",'original_price'=>6,'price'=>12,'sale'=>20,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','20/03/2023 00:00:00')],
            
        ];
        try {
            foreach ($products as $pro) {
                DB::table('product')->insert($pro);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
