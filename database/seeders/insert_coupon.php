<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_coupon extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons =[
            ["title"=>"New Member",'code'=>"NEWMEM",'discount'=>40,'max'=>1,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','15/11/2022 00:00:00')],
            ["title"=>"Free Ship",'code'=>"FREESHIP423",'discount'=>2,'max'=>3,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','01/04/2023 00:00:00')],
            ["title"=>"Free Ship",'code'=>"FREESHIP522",'discount'=>2,'max'=>3,'status'=>false,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','01/05/2022 00:00:00')],
        ];
        try {
            foreach($coupons as $cp){
                DB::table('coupon')->insert($cp);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
