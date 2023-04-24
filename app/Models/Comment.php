<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table= 'comment';
    protected $primaryKey = 'id_comment';
    public function Product(){
        return $this->belongsTo(Product::class,'id_product','id_product');
    }
    public function User(){
        return $this->belongsTo(User::class,'id_user','id_user');
    }
}
