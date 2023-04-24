<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
class insert_user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            ['name'=>'admin','email'=>'admin@gmail.com','phone'=>"01244345692",'password'=>Hash::make(123456),'admin'=>'1','created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','23/11/2022 00:00:00')],
            ['name'=>'guest 1','email'=>'guest1@gmail.com','phone'=>'01243234568','password'=>Hash::make(123456),'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','21/01/2023 00:00:00')],
            ['name'=>'guest 2','email'=>'guest2@gmail.com','phone'=>'01243234666','password'=>Hash::make(123456),'created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','21/01/2023 00:00:00')],
            ['name'=>'Cat Tuong','email'=>'cattuongw2000@gmail.com','avatar'=>'user_0_meme-2.jpg','phone'=>'0919941037','password'=>Hash::make(123456),'admin'=>'1','created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','23/11/2022 00:00:00')],
            ['name'=>'host','email'=>'host@gmail.com','phone'=>'01233231331','password'=>Hash::make(123456),'admin'=>'2','created_at'=>Carbon::createFromFormat('d/m/Y H:i:s','21/03/2023 00:00:00')]
        ];
        try {
            foreach($user as $usr){
                DB::table('users')->insert($usr);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
