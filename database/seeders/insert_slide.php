<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_slide extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides= [
            ['image'=>"slide-1.jpg",'title'=>"SuperMarket For Fresh Gorcery",'title_color'=>'#000000','content'=>'Always supply a high-quality product at a cheaper cost for everyone','content_color'=>'#5C6C75','link'=>"",'btn_content'=>"Shop Now",'attr'=>"",'alert'=>"New Product",'alert_color'=>'#000000','alert_bg'=>"#FFC107",'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
            ['image'=>"slider-2.jpg",'title'=>"Free Shipping - orders over $100",'title_color'=>'#000000','content'=>'Signup to to get coupon -40% for first order','content_color'=>'#5C6C75','link'=>"",'btn_content'=>"Sign Up",'attr'=>"",'alert'=>"Get coupon",'alert_color'=>'#000000','alert_bg'=>"#FFC107",'created_at'=>Carbon::now()->format('Y-m-d H:i:s')],
        ];
        try {
            foreach($slides as $sl){
                DB::table('slide')->insert($sl);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
