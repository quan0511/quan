<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $table = 'typeproduct';
    protected $primaryKey = 'id_type';
    public function Product(){
        return $this->hasMany(Product::class,'id_type','id_type');
    }
}
