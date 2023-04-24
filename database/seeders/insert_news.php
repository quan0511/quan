<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class insert_news extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            ["order_code"=>'USR3_3','id_user'=>3,"title"=>"How do you think about your order?","link"=>"feedback","attr"=>"USR3_3",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '17/04/2023 00:00:00')],
            ['order_code'=>'USR2_2','id_user'=>2,'send_admin'=>true,"title"=>"Order Transaction Failed","link"=>"USR2_2",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '10/04/2023 00:00:00')],
	    	["order_code"=>'USR3_2','id_user'=>3,'send_admin'=>true,"title"=>"Order Cancel","link"=>"USR3_2",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '18/04/2023 11:00:00')],
            ["order_code"=>'USR3_3','id_user'=>3,'send_admin'=>true,"title"=>"New Order","link"=>"USR3_3",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '17/04/2023 00:00:00')],
            ["order_code"=>'GUT_2','send_admin'=>true,"title"=>"New Order","link"=>"GUT_2",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '17/04/2023 00:00:00')],
	    	["order_code"=>'GUT_0','send_admin'=>true,"title"=>"Order Cancel","link"=>"GUT_0",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s',  '18/03/2023 00:00:00')],
            ["title"=>"New Product",'link'=>"products-details","attr"=>"17",'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],

        ];
        try {
            foreach ($news as $new) {
                DB::table('news')->insert($new);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
