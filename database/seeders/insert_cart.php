<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class insert_cart extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carts =[
            ["order_code"=>"USR2_0","id_user"=>2,"id_product"=>10,'price'=>22,'sale'=>0,'amount'=>200,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/03/2023 00:00:00')],
            ["order_code"=>"USR2_0","id_user"=>2,"id_product"=>4,'price'=>13,'sale'=>0,'amount'=>400,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/03/2023 00:00:00')],
            ["order_code"=>"USR2_0","id_user"=>2,"id_product"=>1,'price'=>15,'sale'=>10,'amount'=>100,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/03/2023 00:00:00')],
            ["order_code"=>"USR2_0","id_user"=>2,"id_product"=>3,'price'=>22,'sale'=>12,'amount'=>100,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/03/2023 00:00:00')],
            ["order_code"=>"USR2_1","id_user"=>2,"id_product"=>12,'price'=>31,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/04/2023 00:00:00')],
            ["order_code"=>"USR2_1","id_user"=>2,"id_product"=>15,'price'=>11,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','09/04/2023 00:00:00')],
            ["order_code"=>"USR2_2","id_user"=>2,"id_product"=>11,'price'=>22,'sale'=>2,'amount'=>300,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["order_code"=>"USR3_0","id_user"=>3,"id_product"=>9,'price'=>22,'sale'=>0,'amount'=>400,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["order_code"=>"USR3_0","id_user"=>3,"id_product"=>10,'price'=>12,'sale'=>10,'amount'=>300,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["order_code"=>"USR3_0","id_user"=>3,"id_product"=>8,'price'=>8,'sale'=>0,'amount'=>200,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["order_code"=>"USR3_0","id_user"=>3,"id_product"=>7,'price'=>19,'sale'=>10,'amount'=>1000,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["order_code"=>"USR3_1","id_user"=>3,"id_product"=>6,'price'=>15,'sale'=>10,'amount'=>100,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','16/04/2023 00:00:00')],
            ["order_code"=>"USR3_1","id_user"=>3,"id_product"=>4,'price'=>10,'sale'=>20,'amount'=>160,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','16/04/2023 00:00:00')],
            ["order_code"=>"USR3_2","id_user"=>3,"id_product"=>14,'price'=>10,'sale'=>20,'amount'=>160,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023  11:00:00')],
            ["order_code"=>"USR3_2","id_user"=>3,"id_product"=>9,'price'=>19,'sale'=>0,'amount'=>460,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023  11:00:00')],
            ["order_code"=>"USR3_2","id_user"=>3,"id_product"=>10,'price'=>19,'sale'=>0,'amount'=>460,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023  11:00:00')],
            ["order_code"=>"USR3_3","id_user"=>3,"id_product"=>6,'price'=>23,'sale'=>0,'amount'=>440,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"USR3_3","id_user"=>3,"id_product"=>2,'price'=>21,'sale'=>20,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"USR3_3","id_user"=>3,"id_product"=>11,'price'=>27,'sale'=>10,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"USR3_4","id_user"=>3,"id_product"=>12,'price'=>27,'sale'=>40,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','14/04/2023 00:00:00')],
            ["order_code"=>"USR3_4","id_user"=>3,"id_product"=>8,'price'=>17,'sale'=>0,'amount'=>200,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','14/04/2023 00:00:00')],
            ["order_code"=>"USR3_4","id_user"=>3,"id_product"=>6,'price'=>21,'sale'=>0,'amount'=>200,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','14/04/2023 00:00:00')],
            ["order_code"=>"USR3_4","id_user"=>3,"id_product"=>14,'price'=>21,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','14/04/2023 00:00:00')],
            ["order_code"=>"GUT_0","id_product"=>15,'price'=>20,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/03/2023 00:00:00')],
            ["order_code"=>"GUT_0","id_product"=>12,'price'=>14,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/03/2023 00:00:00')],
            ["order_code"=>"GUT_1","id_product"=>11,'price'=>14,'sale'=>0,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','03/04/2023 00:00:00')],
            ["order_code"=>"GUT_1","id_product"=>13,'price'=>20,'sale'=>10,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','03/04/2023 00:00:00')],
            ["order_code"=>"GUT_1","id_product"=>9,'price'=>18,'sale'=>0,'amount'=>200,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','03/04/2023 00:00:00')],
            ["order_code"=>"GUT_2","id_product"=>16,'price'=>23,'sale'=>10,'amount'=>1000,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"GUT_2","id_product"=>12,'price'=>33,'sale'=>10,'amount'=>300,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"GUT_2","id_product"=>11,'price'=>12,'sale'=>10,'amount'=>340,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
            ["order_code"=>"GUT_2","id_product"=>13,'price'=>21,'sale'=>10,'amount'=>500,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','17/04/2023 00:00:00')],
        ];
        try {
            foreach ($carts as $cart) {
                DB::table('cart')->insert($cart);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
