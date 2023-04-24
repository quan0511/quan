<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_address extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            ['id_user'=>3,'receiver'=>"Ahri","address"=>"10 Đường gì đấy, Xã Lai Uyên, Huyện Bàu Bàng, Bình Dương",'shipment_fee'=>3,"phone"=>"01901919123","email"=>'cattuongw2000@gmail.com','default'=>true,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/01/2023 00:00:00')],
            ['id_user'=>2,'receiver'=>"Jinx","address"=>"34B Đường, Xã Trà Thanh, Huyện Tây Trà, Tỉnh Quảng Ngãi",'shipment_fee'=>3,"phone"=>"01901919123","email"=>'didi01092k@gmail.com','created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/02/2023 00:00:00')],
            ['id_user'=>3,'receiver'=>"Melaine","address"=>"33 Đường, Xã Việt Tiến, Huyện Bảo Yên, Tỉnh Lào Cai",'shipment_fee'=>3,"phone"=>"01901919123","email"=>'cattuongw2018@gmail.com','created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/12/2022 00:00:00')],
            ['id_user'=>2,'receiver'=>"Cat Tuong",'address'=>"135 Tran Hung Dao, Phuong Cau Ong Lanh, Quan 1, TP Ho Chi Minh",'phone'=>"0919941037",'email'=>"cattuongw2000@gmail.com",'default'=>true,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/11/2022 00:00:00')],
            ['id_user'=>4,'receiver'=>"Cat Tuong",'address'=>"12 Le Van Sy, Phuong 5, Quan 3, TP Ho Chi Minh",'phone'=>"09219221124",'email'=>"cattuongw2018@gmail.com",'default'=>true,'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','10/01/2023 00:00:00')]
        ];
        try {
            foreach($addresses as $add){
                DB::table('address')->insert($add);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
