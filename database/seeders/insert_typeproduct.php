<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class insert_typeproduct extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ["type"=>"vegetable"],
            ["type"=>"fruit"],
            ["type"=>"meat"]
        ];
        try {
            foreach($types as $type){
                DB::table('typeproduct')->insert($type);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
