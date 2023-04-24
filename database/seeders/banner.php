<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class banner extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners =[
            ["image"=>'grocery-banner.png','title'=>"Fruits & Vegetables",'content'=>'Get Upto 30% Off','btn_content'=>'Shop Now'],
            ["image"=>'grocery-banner-2.png','title'=>"Freshly Baked Buns",'content'=>'Get Upto 25% Off','btn_content'=>'Shop Now'],
            ["image"=>'banner-deal.jpg','title'=>"100% Organic Stawberry",'title_color'=>'#FFFFFF','content'=>'Get the best deal before close.','content_color'=>"#FFFFFF",'btn_content'=>'Shop Now','btn_bg_color'=>"#099309",'btn_color'=>'#000000'],
        ]; 
        try {
            foreach($banners as $banner){
                DB::table('banner')->insert($banner);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
