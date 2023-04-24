<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Library;
use App\Models\TypeProduct;
use App\Models\Comment;

class UserController extends Controller
{
    public function index(){
        $prods = Product::all();
        $rate = Comment::all();
        
        return view('user.pages.Products.index', compact('prods','rate'));
    }
 
    public function findByName(Request $request)
    {
        $name = $request->name;
        $prods = Product::where('name','like','%'.$name.'%')->get();

        return view('user.pages.Products.index', compact('prods','name'));
    }
    

}
