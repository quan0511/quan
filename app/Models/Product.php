<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id_product';

    public function libraries()
    {
        return $this->hasMany(Library::class, 'id_product','id_product');
    }
    public function TypeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id_type', 'id_type');
    }
    public function Comment()
    {
        return $this->hasMany(Comment::class, 'id_product', 'id_product');
    }
    public function Library(){
        return $this->hasMany(Library::class,'id_product','id_product');
    }
    public function Cart(){
        return $this->hasMany(Cart::class,'id_product','id_product');
    }
}
