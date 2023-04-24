<?php

namespace Database\Seeders;
use Illuminate\Support\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_comment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            ["id_product"=>1,'id_user'=>2,'verified'=>true,'context'=>"So so good",'rating'=>5,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','15/03/2023 00:00:00')],
            ["id_product"=>3,'id_user'=>2,'verified'=>true,'context'=>"So so delicious",'rating'=>5,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','15/03/2023 00:00:00')],
            ["id_product"=>4,'id_user'=>2,'verified'=>true,'context'=>"So so good",'rating'=>4,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','15/03/2023 00:00:00')],
            ["id_product"=>10,'id_user'=>2,'verified'=>true,'context'=>"So so good",'rating'=>3,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','15/03/2023 00:00:00')],
            ["id_product"=>2,'id_user'=>2,'context'=>"Just a commment",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','02/04/2023 00:00:00')],
            ["id_product"=>5,'id_user'=>1,'context'=>"Just a good",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','03/04/2023 00:00:00')],
            ["id_product"=>8,'id_user'=>2,'context'=>"Just a some comment",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','02/03/2023 00:00:00')],
            ["id_product"=>1,'id_user'=>1,'context'=>"Change this comment",'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','01/04/2023 00:00:00')],
            ["id_product"=>9,'id_user'=>3,'verified'=>true,'context'=>"So so good",'rating'=>4,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["id_product"=>10,'id_user'=>3,'verified'=>true,'context'=>"So so good",'rating'=>4,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["id_product"=>8,'id_user'=>3,'verified'=>true,'context'=>"So so good",'rating'=>3,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
            ["id_product"=>7,'id_user'=>3,'verified'=>true,'context'=>"So so good",'rating'=>5,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/04/2023 00:00:00')],
        ];
        try {
            foreach($comments as $cmt){
                DB::table('comment')->insert($cmt);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
