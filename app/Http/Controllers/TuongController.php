<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Library;
use App\Models\Banner;
use App\Models\Order;
use App\Models\Favourite;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\News;
use App\Models\User;
use App\Models\Comment;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
class TuongController extends Controller
{
    public function home_page(){
        // $news = News::where('send_admin', '=', false)->where(function (Builder $query) {
        //     $query->where('id_user', '=', Auth::user()->id_user)
        //           ->orWhere('id_user', '=', null);
        // })->get();
        // dd($news);
        $products = Product::where('quantity','>',0)->inRandomOrder()->limit(10)->get();
        $product_hot = Product::where('quantity','>',0)->where('sale','>',0)->inRandomOrder()->limit(3)->get();
        $banner = Banner::all();
        return view('user.index',compact('products','product_hot','banner'));
    }
    public function get_signUp(){
        $site= "Signup";
        return view('user.pages.Signup.index',compact('site'));
    }
    public function get_order(){
        if(Session::has('coupon')){
            $coupon =Coupon::find(Session::get('coupon')); 
            $coupon->freeship = Coupon::where('id_coupon','=',Session::get('coupon'))->where('code','LIKE','%FREESHIP%')->first() ? true :false;
        }else{
            $coupon = null;
        }
        if(Auth::check()){
            $carts = Cart::where('id_user','=',Auth::user()->id_user)->where('order_code','=',null)->get();
        }else{
            $carts = Session::get('cart');
        }
        return view('user.pages.Orders.index',compact('carts','coupon'));
    }
    public function add_address(Request $req){
        $newAdd = new Address();
        $newAdd->id_user =Auth::user()->id_user;
        $newAdd->receiver = $req['nameReciever'];
        $newAdd->address = $req['addressReciever'].", ". $req['ward'].', '.$req['district'].", ".$req['province'];
        $newAdd->shipment_fee = $req['province'] != "Thành phố Hồ Chí Minh" ? 3:2;
        $newAdd->phone = $req['phoneReciever'];
        $newAdd->email = $req['emailReciever'];
        if(isset($req['saveAddress'])){
            $defautlAddress = Address::where('id_user','=',Auth::user()->id_user)->where('default','=',true)->first();
            if($defautlAddress){
                $defautlAddress->default = false;
                $defautlAddress->save();
            }
            $newAdd->default = true;
        };
        $newAdd->save();
        return redirect()->back();
    }
    public function remove_address($id){
        $add = Address::where('id_address','=',$id)->first();
        $add->delete();
        return redirect()->back()->with('message','Delete Address successfully');
    }
    public function check_email($email){
        $checkEmail = User::where('email','=',$email)->get();
        $msg = "";
        if(count($checkEmail)>0){
            $msg = "existed";
        }
        echo $msg;
    }
    public function post_signUp(Request $req){
        $new_user = new User();
        $new_user->name = $req["register_name"];
        $new_user->email = $req["register_email"];
        $new_user->password = bcrypt($req["register_password"]);
        $new_user->phone = $req["register_phone"];
        if($req->hasFile('register_avatar')){
            $file = $req->file('register_avatar');
            $type = $file->getClientOriginalExtension();
            if($type != "jpg" && $type != "png" && $type != "jpeg" && $type!= "webp"){
                return redirect()->back()->with('error','File image must be jpg,png,jpeg,webp');
            }
            $name = $file->getClientOriginalName();
            $num=0;
            $image_user = "user_".$num."_".$name;
            while(file_exists('images/avatar/'.$image_user)){
                $num++;
                $image_user = "user_".$num."_".$name;
            };
            $file->move('images/avatar/',$image_user);
            $new_user->avatar = $image_user;
        }else{
            $new_user->avatar= null;
        };
        $new_user->created_at= Carbon::now()->format('Y-m-d H:i:s');
        $new_user->save();
        $vali = ["email"=>$new_user->email,"password"=>$req["register_password"]];
        if(Auth::attempt($vali)){
            if(Session::has("cart")){
                $cart_session = Session::get("cart");
                foreach($cart_session as $key => $value){
                    $addToUserCart = new Cart();
                    $addToUserCart->order_code = null;
                    $addToUserCart->id_user = $new_user->id_user;
                    $addToUserCart->id_product = $value["id_product"];
                    $addToUserCart->amount = $value["amount"];
                    $addToUserCart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                    $addToUserCart->save();
                }
                Session::forget("cart");
            };
            return redirect('/');
        }else{
            return redirect()->back()->with('error','Sign up failue. Try again');
        }
    }
    public function get_signIn(){
        $site = "Signin";
        return view('user.pages.Signup.index',compact('site'));
    }
    public function post_signIn(Request $req){
        $arr_vali = ["email"=>$req["email"],"password"=>$req["password"]];
        if(Auth::attempt($arr_vali)){
            if(Session::has("cart")){
                $cart_session = Session::get("cart");
                foreach($cart_session as $key => $value){
                    $foundPro = Auth::user()->Cart->where('id_product','=',$value["id_product"])->where('order_code','=',null)->first();
                    if($foundPro){
                        if(($foundPro->amount + $value["amount"]) >= Auth::user()->Cart->where('id_product','=',$value["id_product"])->first()->Product->quantity){
                            $foundPro->amount = Auth::user()->Cart->where('id_product','=',$value["id_product"])->first()->Product->quantity;
                        }else{
                            $foundPro->amount += $value["amount"];
                        };
                        $foundPro->save();
                    }else{
                        $addToUserCart = new Cart();
                        $addToUserCart->order_code = null;
                        $addToUserCart->id_user = Auth::user()->id_user;
                        $addToUserCart->id_product = $value["id_product"];
                        $addToUserCart->amount = $value["amount"];
                        $addToUserCart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                        $addToUserCart->save();
                    }
                }
                Session::forget("cart");
            };
            
            return redirect('/');
        }else{
            return redirect()->back()->with(["error"=>"Sign in failue. Password or username incorrect"]);
        };
    }
    public function signOut(){
        Session::forget('coupon');
        Session::forget('compare');
        Session::forget('cart');
        Auth::logout();
        return redirect('/');
    }
    public function product_detail($id){
        $product = Product::find($id);
        $related_products = Product::where('id_type', $product->id_type)->where('id_product', '<>', $id)
            ->take(5)
            ->get();
        $comments= Comment::where('id_product','=',$id)->get();
        return view('user.pages.ProductDetails.index',compact('product','related_products','comments'));
    }
    public function post_comment(Request $req){
        $comment = new Comment();
        $comment->id_user = Auth::user()->id_user;
        $comment->id_product = $req['id_product'];
        $comment->context = $req['comment'];
        $comment->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $comment->save();
        return redirect()->back();
    }
    public function editCmt(Request $req,$id){
        $cmt = Comment::find($id);
        if(isset($req['rating_cmt'])){
            $cmt->rating = $req['rating_cmt'];
        };
        $cmt->context = $req['content_cmt'];
        $cmt->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $cmt->save();
        return redirect()->back(); 
    }
    public function deleteCmt($id){
        $comt = Comment::find($id);
        $comt->delete();
        return redirect()->back();
    }
    public function get_checkout(){
        if(Session::has('coupon')){
            $coupon =Coupon::find(Session::get('coupon')); 
            $coupon->freeship = Coupon::where('id_coupon','=',Session::get('coupon'))->where('code','LIKE','%FREESHIP%')->first() ? true :false;
        }else{
            $coupon = null;
        }
        if(Auth::check()){
            $cart = Cart::where('id_user','=',Auth::user()->id_user)->where('order_code','=',null)->get();
            $address = Auth::user()->Address->sortByDesc('default');
        }else{
            $cart = Session::get('cart');
            $address = null;
        }
        return view('user.pages.Orders.checkout',compact('cart','address','coupon'));
    }
    public function post_checkout(Request $req){
        $order = new Order();
        if(Auth::check()){
            $order->id_user = Auth::user()->id_user;
            $order_code = "USR".Auth::user()->id_user."_".count(Auth::user()->Order);
            $order->order_code = $order_code;
            $address = Address::find($req['select_address']);
            $order->receiver = $address['receiver']; 
            $order->phone = $address['phone'];
            $order->email = $address['email'];
            $order->address = $address['address'];
            $order->code_coupon = $req['code_coupon'];
            foreach(Cart::where('order_code','=',null)->where('id_user','=',Auth::user()->id_user)->get() as $cart){
                $cart->Product->quantity-=$cart->amount;
                $cart->Product->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $cart->Product->save();
                $cart->order_code = $order_code;
                $cart->price = $cart->Product->price;
                $cart->sale = $cart->Product->sale;
                $cart->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $cart->save();
            }
        }else{
            $nnum = count(Order::where('order_code','LIKE','%GUT%')->get());
            $order_code = "GUT_".$nnum;
            $current_guest_cart = Session::get('cart');
            foreach($current_guest_cart as $key => $value){
                $guest_cart = new Cart();
                $guest_cart->order_code=$order_code;
                $guest_cart->id_product= $value["id_product"];
                $guest_cart->price = $value["per_price"];
                $guest_cart->sale = $value["sale"];
                $guest_cart->amount = $value["amount"];
                $guest_cart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $guest_cart->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $guest_cart->save();
                $product = Product::where('id_product','=',$value["id_product"])->first();
                $product->quantity -=$value["amount"];
                $product->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $product->save();
            }
            Session::remove("cart");
            $order->order_code = $order_code;
            $order->receiver = $req['nameReciever'];
            $order->phone = $req['phoneReciever'];
            $order->email = $req['emailReciever'];
            $order->address = $req['addressReciever'].", ".$req['ward'].", ".$req['district']. ", ".$req['province'];
            $order->method = $req['order_method'];
            $order->code_coupon = $req['code_coupon'];
        }
        $order->shipping_fee = $req['shipment_fee'];
        $order->status = 'unconfimred';
        $order->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $order->save();
        $new_admin = new News();
        $new_admin->order_code = $order->order_code;
        $new_admin->title = "New Order!! Let confirm the order";
        $new_admin->link = $order->order_code;
        $new_admin->send_admin = true;
        $new_admin->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $new_admin->save();
        Session::forget('coupon');
        Mail::to($order->email)->send(new OrderShipped($order));
        return redirect('/')->with('order_mess',"Order Successfully, plz wait for Admin Confirm");
    }
    public function admin_cate(){
        $products = Product::all();
        return view('admin.pages.Categories.index',compact('products'));
    }
    public function addToCart(Request $req, $id=null){
        $foundPro =[];
        $req->validate([
            "quan" => "required"
        ],[
            "quan.required"=>"You need choose at least 1 item",
        ]);
        $product = Product::where('id_product','=',$req["id_pro"])->first();
        $maxQuan = $product->quantity;
        $amount = intval($req["quan"]);
        if(intval($req["quan"]) >$maxQuan){
            $amount = $maxQuan;
        }
        $price = $product->price;
        $name = $product->name;
        $imgPro = $product->Library[0]->image;
        // dd($imgPro);
        if(Auth::check()){
            $foundPro = Auth::user()->Cart->where('id_product','=',$req["id_pro"])->where('order_code','=',null)->first();
            if($foundPro){
                $sum_quant = $amount+ $foundPro->amount; 
                if($sum_quant > $maxQuan){
                    $sum_quant = $maxQuan;
                };
                $foundPro->amount  = $sum_quant;
                $foundPro->save();
            }else{
                $cart = new Cart();
                $cart->id_user = Auth::user()->id_user;
                $cart->order_code = null;
                $cart->id_product = $req->id_pro;
                $cart->amount = $amount;
                $cart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $cart->save();
            }
        }else if(Session::has("cart")){
            $check = true;
            $arr_cart = Session::get("cart");
            $arr_new = [];
            foreach($arr_cart as $key => $value){
                if($value["id_product"] == $req["id_pro"]){
                    $addQuan = ($value["amount"]+$amount) > $maxQuan ? $maxQuan : $value["amount"]+$amount;
                    array_push($arr_new,["id_product" => $value["id_product"],"amount"=>$addQuan,"per_price"=>$value["per_price"],"name"=>$value["name"],"max"=>$value["max"],"image"=>$imgPro,'sale'=>$value['sale']]);
                    $check = false;
                }else{
                    array_push($arr_new,$value);
                }
            }
            if($check){
                $new = ["id_product"=>$req["id_pro"],"amount"=>$amount,"per_price"=>$price,"name"=>$name,"max"=>$maxQuan,"image"=>$imgPro,'sale'=>$product->sale];
                Session::push("cart",$new);
            }else{
                Session::put("cart",$arr_new);
            }
        }else{
            $cart_session = ["id_product"=>$req["id_pro"],"amount"=>$amount,"per_price"=>$price,"name"=>$name,"max"=>$maxQuan,"image"=>$imgPro,'sale'=>$product->sale];
            Session::push("cart",$cart_session);
        };
        return redirect()->back()->with(["message"=>"Add to cart successfull"]);
    }
    public function addToCart2($id){
        $product= Product::find($id);
        $num =0;
        if(Auth::check()){
            $foundPro = Auth::user()->Cart->where('id_product','=',$id)->where('order_code','=',null)->first();
            if($foundPro){
                if($foundPro->amount == $foundPro->Product->quantity){
                    return redirect()->back()->with(["warning"=>"Add to cart failue! You got maximum"]);
                }else{
                    $newAmount = ($foundPro->amount + 100)>$product->quantity ? $product->quantity : $foundPro->amount + 100;
                    $foundPro->amount = $newAmount;
                    $foundPro->save();
                }
            }else{
                $cart = new Cart();
                $cart->id_user = Auth::user()->id_user;
                $cart->order_code = null;
                $cart->id_product = $id;
                $cart->amount = $product->quantity < 100 ? $product->quantity:100;
                $cart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $cart->save();
            };
            $num = count(Auth::user()->Cart->where('order_code','=',null))+ 1;
        }else if(Session::has("cart")){
            $check = true;
            $arr_cart = Session::get("cart");
            $arr_new = [];
            foreach($arr_cart as $key => $value){
                if($value["id_product"] == $id){
                    $addQuan = ($value["amount"]+100) > $product->quantity ? $product->quantity : $value["amount"]+100;
                    array_push($arr_new,["id_product" => $value["id_product"],"amount"=>$addQuan,"per_price"=>$value["per_price"],"name"=>$value["name"],"max"=>$value["max"],"image"=>$value["image"],'sale'=>$value['sale']]);
                    $check = false;
                }else{
                    array_push($arr_new,$value);
                }
            }
            if($check){
                $new = ["id_product"=>$id,"amount"=>100,"per_price"=>$product->price,"name"=>$product->name,"max"=>$product->quantity,"image"=>$product->Library[0]->image,'sale'=>$product->sale];
                $num = count($arr_cart)+1;
                array_push($arr_new,$new);
                Session::put("cart",$arr_new);
            }else{
                $num = count($arr_cart);
                Session::put("cart",$arr_new);
            }
        }else{
            $num+=1;
            $cart_session = ["id_product"=>$id,"amount"=>100,"per_price"=>$product->price,"name"=>$product->name,"max"=>$product->quantity,"image"=>$product->Library[0]->image,'sale'=>$product->sale];
            Session::push("cart",$cart_session);
        };
        echo $num;
    }
    public function minusOne($id){
        if(Auth::check()){
            $product = Cart::find($id);
            if($product->amount ==100){
                $product->delete();
            }else{
                $product->amount -=100;
                $product->save();
            }
        }else{
            $session_cart = Session::get("cart");
            $new_session = [];
            for($i = 0; $i<count($session_cart);$i++){
                if($i == $id){
                    $minus = $session_cart[$i]["amount"]-100;
                    if($minus>0){
                        array_push($new_session,["id_product"=>$session_cart[$i]["id_product"],"amount"=>$minus,"per_price"=>$session_cart[$i]["per_price"],"name"=>$session_cart[$i]["name"],"max"=>$session_cart[$i]["max"],"image"=>$session_cart[$i]["image"],'sale'=>$session_cart[$i]['sale']]);
                    }
                }else{
                    array_push($new_session,["id_product"=>$session_cart[$i]["id_product"],"amount"=>$session_cart[$i]["amount"],"per_price"=>$session_cart[$i]["per_price"],"name"=>$session_cart[$i]["name"],"max"=>$session_cart[$i]["max"],"image"=>$session_cart[$i]["image"],'sale'=>$session_cart[$i]['sale']]);
                }
            };
            Session::put("cart",$new_session);
        }
        return redirect()->back();
    }
    public function addMore($id){
        if(Auth::check()){
            $product = Cart::find($id);
            if($product->Product->quantity > $product->amount){
                $newAmount = $product->Product->quantity > ($product->amount +100)? $product->amount +100 : $product->Product->quantity;
                $product->amount = $newAmount;
                $product->save();
            }
        }
        else{
            $session_cart = Session::get("cart");
            $new_session = [];
            for($i = 0; $i<count($session_cart);$i++){
                if($i == $id){
                    $addOne = ($session_cart[$i]["amount"]+100) > $session_cart[$i]['max']? $session_cart[$i]['max']: $session_cart[$i]["amount"]+100;
                    array_push($new_session,["id_product"=>$session_cart[$i]["id_product"],"amount"=>$addOne,"per_price"=>$session_cart[$i]["per_price"],"name"=>$session_cart[$i]["name"],"max"=>$session_cart[$i]["max"],"image"=>$session_cart[$i]["image"],'sale'=>$session_cart[$i]['sale']]);
                }else{
                    array_push($new_session,["id_product"=>$session_cart[$i]["id_product"],"amount"=>$session_cart[$i]["amount"],"per_price"=>$session_cart[$i]["per_price"],"name"=>$session_cart[$i]["name"],"max"=>$session_cart[$i]["max"],"image"=>$session_cart[$i]["image"],'sale'=>$session_cart[$i]['sale']]);
                }
            };
            Session::put("cart",$new_session);
        }
        return redirect()->back()->with('message',"Add one more product into your cart successfully!");
    }
    public function modalCart(){
        $list_cart = [];
        $sum =0;
        $html_list = "";
        if(Auth::check()){
            $list_cart = Cart::where('order_code','=',null)->where('id_user','=',Auth::user()->id_user)->get();
            if(count($list_cart)>0){
                foreach($list_cart as $key => $cart){
                    
                    $html_list.="<li class='list-group-item py-3 ps-0 border-top border-bottom'>
                        <div class='row align-items-center'>
                        <div class='col-3 col-md-2'>
                            <img src='images/products/".$cart->Product->Library[0]->image."' alt='".$cart->Product->name."' class='img-fluid' style='width: 200px'></div>
                        <div class='col-4 col-md-6 col-lg-5'>
                            <a href='".route('products-details',$cart->Product->id_product)."' class='text-inherit'>
                            <h6 class='mb-0'>".$cart->Product->name."</h6>
                            </a>
                            <span><small class='text-muted'>".$cart->Product->TypeProduct->type."</small></span>
                            <div class='mt-2 small lh-1'> 
                                <a href='".route('removeId',$cart->id_cart)."' class='text-decoration-none text-inherit'> 
                                   <span class='text-muted'>Remove</span>
                                </a>
                            </div>
                        </div>
                        <div class='col-3 col-md-3 col-lg-3 '>
                        <form method='POST' action='".route('cartadd',$cart->id_cart)."' class='d-flex flex-column'>
                        <input type='hidden' name='_token' value=''>
                            <div class='input-group input-spinner input-group-sm'>
                                <a href='".route('minus',[$cart->id_cart])."' class='text-decoration-none btn'>
                                <i class='bi bi-dash-lg'></i>
                                </a>
                                <input type='text' value='$cart->amount' name='cart_quant'  class='form-control form-input'  >";
                    if ($cart->amount < $cart->Product->quantity){
                        $html_list.="<a href='".route('addmore',[$cart->id_cart])."' class='text-decoration-none btn' >
                        <i class='bi bi-plus-lg'></i>
                        </a>";
        
                    }else{
                        $html_list.="<a class='disabled btn border-0'><i class='fa-solid fa-plus'></i></a>";
                    };
                    $html_list.="</div></form></div><div class='col-2 text-lg-end text-start text-md-end col-md-2'>";
                    if($cart->Product->sale > 0 ){
                        $sum += $cart->Product->price/100 *(1- ($cart->Product->sale /100)) * $cart->amount;
                        $html_list.= "<span class='fw-bold text-danger fs-5'>$". $cart->Product->price * (1-$cart->Product->sale/100)."</span><span class='text-decoration-line-through ms-1'>".$cart->Product->price ."</span></div></div></li>";
                    }else{
                        $sum += $cart->Product->price/100 * $cart->amount;
                        $html_list.= "<span class='fw-bold'>$".$cart->Product->price."</span></div></div></li>"; 
                    }
                };
                $html_list .="<li class='list-group-item py-3 ps-0 border-top border-bottom'><div class='text-black-50 text-end'><h4>Total: <span class='h4 text-danger'>$".$sum."</span></h4></div></li>";
            }else{
                $html_list .= "<li class='list-group-item py-3 ps-0 border-top border-bottom'><div class='text-black-50 text-center'>Cart is emty</div></li>";
            };
        }else if(Session::has('cart')){
            $list_cart = Session::get('cart');
            if(count($list_cart)>0){
                foreach($list_cart as $key => $cart){
                    
                    $html_list.="<li class='list-group-item py-3 ps-0 border-top border-bottom'>
                    <div class='row align-items-center'>
                    <div class='col-3 col-md-2'>
                    <img src='images/products/".$cart["image"]."' alt='".$cart["name"]."' class='img-fluid' style='width: 200px'>
                    </div>
                        <div class='col-4 col-md-6 col-lg-5'>
                        <a href='".route('products-details',$cart['id_product'])."' class='text-inherit'>
                        <h6 class='mb-0'>".$cart['name']."</h6>
                            </a>
                            <span><small class='text-muted'>".Product::find($cart["id_product"])->TypeProduct->type."</small></span>
                            <div class='mt-2 small lh-1'> 
                            <a href='".route('removeId',$key)."' class='text-decoration-none text-inherit'> 
                               <span class='text-muted'>Remove</span>
                               </a>
                            </div>
                            </div>
                        <div class='col-3 col-md-2 col-lg-3'>
                            <div class='input-group input-spinner input-group-sm'>
                            <a href='".route('minus',[$key])."' class='text-decoration-none btn'>
                            <i class='fa-solid fa-minus text-danger'></i>
                            </a>
                            <input type='text' value='".$cart["amount"]."' name='quantity' class='form-control form-input' readonly>
                            ";
                            if ($cart["amount"] < $cart['max']){
                        $html_list.="<a href='".route('addmore',[$key])."' class='text-decoration-none btn' >
                        <i class='fa-solid fa-plus text-danger'></i>
                        </a>";
                        
                    }else{
                        $html_list.="<a class='disabled btn border-0'><i class='fa-solid fa-plus'></i></a>";
                    };
                    $html_list.="</div></div><div class='col-2 text-lg-end text-start text-md-end col-md-2'>";
                    if(Product::find($cart["id_product"])->sale> 0 ){
                        $sum += intval($cart["per_price"])*(1-$cart["sale"]/100) * intval($cart["amount"])/1000;
                        $html_list.= "<span class='fw-bold text-danger fs-5'>$". intval($cart['per_price'])*(1- ($cart["sale"]/100))." /1kg</span></div></div></li>";
                    }else{
                        $sum += intval($cart["per_price"]) * intval($cart["amount"])/1000;
                        $html_list.= "<span class='fw-bold'>$".$cart['per_price']." /1kg</span></div></div></li>"; 
                    }
                };
                $html_list .="<li class='list-group-item py-3 ps-0 border-top border-bottom'><div class='text-black-50 text-end'><h4>Total: <span class='h4 text-danger'>$".$sum."</span></h4></div></li>";
            }else{
                $html_list .= "<li class='list-group-item py-3 ps-0 border-top border-bottom'><div class='text-black-50 text-center'>Cart is emty</div></li>";
            };
        }
        echo $html_list;
    }
    public function removeCart($id){
        if(Auth::check()){
            $item = Cart::find($id);
            $item->delete();
        }
        if(Session::has("cart")){
            $session_cart = Session::get("cart");
            $new_session = [];
            for($i = 0; $i<count($session_cart);$i++){
                if($i != $id){
                    array_push($new_session,["id_product"=>$session_cart[$i]["id_product"],"amount"=>$session_cart[$i]["amount"],"per_price"=>$session_cart[$i]["per_price"],"name"=>$session_cart[$i]["name"],"max"=>$session_cart[$i]["max"],"image"=>$session_cart[$i]["image"]]);
                }
            };
            Session::put("cart",$new_session);
        }
        return redirect()->back();
    }
    public function clearCart(){
        $html_list="";
        if(Auth::check()){
            $current_cart =  Cart::where('id_user','=',Auth::user()->id_user)->where('order_code','=',null)->get();
            foreach($current_cart as $cart){
                $cart->delete();
            }
        }else if(Session::has('cart')){
            Session::forget("cart");
        }
        $html_list .= "<li class='list-group-item py-3 ps-0 border-top border-bottom'><div class='text-black-50 text-center'>Cart is emty</div></li>";
        echo $html_list;
    }
    public function cartadd_quan(Request $req, $id){
        $req->validate([
            'cart_quant' =>"required|numeric"
        ],[]);
        if(Auth::check()){
            $cart = Cart::find($id);
            if(intval($req['cart_quant']) == 0){
                $cart->delete();
            }else{
                $cart->amount = $req['cart_quant'] > $cart->Product->quantity?$cart->Product->quantity:$req['cart_quant'] ;
                $cart->save();
            }
        }else{
            $arr_cart = Session::get("cart");
            $arr_new = [];
            foreach($arr_cart as $key => $value){
                if($key == $id){
                    $addQuan = $req['cart_quant'] > intval($value['max']) ? intval($value['max']) : $req['cart_quant'];
                    array_push($arr_new,["id_product" => $value["id_product"],"amount"=>$addQuan,"per_price"=>$value["per_price"],"name"=>$value["name"],"max"=>$value["max"],"image"=>$value['image'],'sale'=>$value['sale']]);
                }else{
                    array_push($arr_new,$value);
                }
            }
            Session::put("cart",$arr_new);
        }
        return redirect()->back();
    }
    public function modal_product($id){
        $product = Product::find($id);
        $arrImg = [];
        foreach($product->Library as $img){
            $arrImg[] = $img->image;
        }
        $product->images = $arrImg;
        $product->type = Product::find($id)->TypeProduct->type;
        $product->favourite = Auth::check()? (count(Favourite::where('id_user','=',Auth::user()->id_user)->where('id_product','=',$id)->get())>0? true: false):false;
        $rating = 0;
        $commt = Comment::where('rating','!=',null)->where('id_product','=',$id)->get();
        if(count($commt)>0){
            foreach( $commt as $rate){
                $rating += $rate->rating;
            }
            $rating /= count($commt);
        }
        $product->rating = $rating;
        $product->sold = count($commt);
        echo $product;
    }
    public function add_favourite($id){
        $product = Product::find($id);
        $found_fav = Favourite::where('id_user','=',Auth::user()->id_user)->where('id_product','=',$id)->first();
        if(!$found_fav){
            $new_fav = new Favourite();
            $new_fav->id_user = Auth::user()->id_user;
            $new_fav->id_product = $product->id_product;
            $new_fav->created_at=Carbon::now()->format('Y-m-d H:i:s');
            $new_fav->save();
        }else{
            $found_fav->delete();
        }
        $num = count(Auth::user()->Favourite);
        echo $num;
    }
    public function addCompare($id){
        $msg="";
        $product = Product::find($id);
        $rating  = 0;
        if(count($product->Comment->where('rating','!=',null))>0){
            foreach($product->Comment->where('rating','!=',null) as $rate){
                $rating += $rate->rating;
            }
            $rating /= count($product->Comment->where('rating','!=',null));
        };
        $product->image = $product->Library[0]->image;
        $product->rating = $rating;
        $product->sold = count($product->Comment->where('rating','!=',null));
        if(Session::has('compare')){
            if(count(Session::get('compare'))<=2){
                Session::push('compare',$product);
            }
            $msg.="Add (".count(Session::get('compare'))."/3) Product to compare";
        }else{
            $msg.="Add (1/3) Product to compare";
            Session::put('compare',[$product]);
        }
        echo $msg;
    }
    public function showCompare(){
        $cmp = "";
        $info = ["Image","Name","Type","Quantity","Status","Description","Rating","Sold","Price",'Delete'];
        for($i =0; $i<count($info);$i++){
            $cmp.="<tr><td>".$info[$i]."</td>";
            foreach(Session::get('compare') as $key=> $product){
                switch($i){
                    case 0: 
                        $cmp.="<td><img src='images/products/$product->image' width='160' class='img-fluid' style='object-fit:cover'/></td>";
                        break;
                    case 1:
                        $cmp.="<td class='text-dark'>$product->name</td>";
                        break;
                    case 2: 
                        $prod = Product::find($product['id_product']);
                        $cmp.="<td class='text-dark'>".$prod->TypeProduct->type."</td>";
                        break;
                    case 3:
                        $cmp .= "<td class='text-dark'>".number_format($product->quantity,2,',',' ')."g</td>";
                        break;
                    case 4:
                        $status = $product->status? "In Stock": "Out Stock";
                        $cmp .="<td class='text-dark'>".$status."</td>";
                        break;
                    case 5:
                        $cmp .= "<td class='text-dark'>".$product->description."</td>";
                        break;
                    case 6:
                        $cmp.="<td>";
                        for($j =0; $j<$product->rating;$j++){
                            $cmp.="<i class='bi bi-star-fill text-warning fs-5'></i>";
                        }
                        for($j = 0; $j < 5-$product->rating;$j++){
                            $cmp.="<i class='bi bi-star text-warning fs-5'></i>";
                        };
                        $cmp.="</td>";
                        break;
                    case 7:
                        $cmp .= "<td class='text-dark'>".$product->sold."</td>";
                        break;
                    case 8:
                        if($product->sale>0){
                            $cmp .= "<td><span class='fs-4 text-danger'>$".($product->price * (1-$product->sale/100))."</span>";
                            $cmp.="<span class='text-muted ms-1'>(Off ".$product->sale."%)</span></td>";
                        }else{
                            $cmp.="<td><span class='fs-4 text-black'>$".$product->price."</span></td>";
                        };
                        break;
                    default:
                        $cmp .="<td><a href='".route('delCmp',$key)."' class='removeCmp btn' data-idcmp=".$key."><i class='bi bi-trash3 text-danger fs-3'></i></button></td>";
                    break;
                }
            };
            $cmp.="</tr>";
        }
        echo $cmp;
    }
    public function delCompare($id){
        $arr_sess = Session::get('compare');
        unset($arr_sess[$id]);
        Session::put('compare',$arr_sess);
        return redirect()->back();
    }
    public function removeCompare(){
        Session::forget('compare');
        return redirect()->back();
    }
    public function addCoupon($coupon){
        $coupon2 = Coupon::where('code','=',$coupon)->where('status','=',true)->first();
        $checkAuth = count(Order::where('code_coupon','=',$coupon)->where('id_user','=',Auth::user()->id_user)->where('status','!=','cancel')->get()) >= $coupon2->max;
        if(!$coupon2 ||$checkAuth){
            $coupon2= ['error'=>!$coupon2?"Promo code is not Invalid":"You have reached the maximum use of this promo code"];
            $coupon2 = json_encode($coupon2);
            Session::forget('coupon');
        }else{
            Session::put('coupon',$coupon2->id_coupon);
        }

        echo $coupon2;
    }

    public function get_wishlist(){
        $favourites = Auth::user()->Favourite;
        return view('user.pages.ShopWishlist.index',compact('favourites'));
    }
    public function post_wishlist(Request $req){
        if(!isset($req->removeFav) && !isset($req->checkFav)){
            return redirect('/order');
        }else if(isset($req->removeFav)){
            foreach($req->checkFav as $id){
                $fav = Favourite::find($id);
                $fav->delete();
            }
        }else{
            foreach($req->checkFav as $id){
                $fav = Favourite::find($id);
                $item = Auth::user()->Cart->where('order_code','=',null)->where('id_product','=',intval($fav->id_product))->first();
                if($item ){
                    $item->amount = $item->Product->quantity >($item->amount +100)?$item->amount +100 : ($item->Product->quantity > $item->amount?$item->Product->quantity: $item->amount);
                    $item->save();
                }else{
                    $new_cart = new Cart();
                    $new_cart->order_code = null;
                    $new_cart->id_user= Auth::user()->id_user;
                    $new_cart->id_product = $fav->id_product;
                    $new_cart->amount=Product::find(intval($fav->id_product))->quantity > 100 ? 100 : Product::find(intval($fav->id_product))->quantity;
                    $new_cart->created_at=Carbon::now()->format('Y-m-d H:i:s');
                    $new_cart->save();
                }
            }
            return redirect('/order');
        };
        return redirect()->back();
    }
    public function get_orderhistory(){
        $orders = Order::where('id_user','=',Auth::user()->id_user)->orderBy('created_at','desc')->get();
        foreach($orders as $order){
            $sum = 0;
            foreach($order->Cart as $cart){
                $sum += $cart->sale > 0? $cart->price*(1 - $cart->sale/100)*($cart->amount/1000): $cart->price*($cart->amount/1000);
            }
            if($order->Coupon){
                if($order->Coupon->discount >= 10){
                    $sum *= (1-$order->Coupon->discount /100);
                }else{
                    $sum-=$order->Coupon->discount;
                }
            }
            $sum += $order->shipping_fee;
            $order->total = $sum;
        }
        // dd($orders);
        return view('user.pages.About.order',compact('orders'));
    }
    public function ajax_getOrder($id){
        $order = Order::find($id);
        if($order->Coupon){
            $order->name_coupon = $order->Coupon->title;
        }else{
            $order->name_coupon = "NO COUPON";
        }
        echo $order;
    }
    public function post_urseditorder(Request $req){
        $order = Order::find($req['id_orderedit']);
        $order->receiver = $req['edit_cusname'];
        $order->address = $req['edit_cusaddr'];
        $order->phone = $req['edit_cusphone'];
        $order->email = $req['edit_email'];
        $order->save();
        $new = new News();
        $new->order_code =$order->order_code;
        $new->link = $order->order_code;
        $new->send_admin = true;
        $new->title = "Customer edited their Order";
        $new->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $new->save();
        return redirect()->back()->with('message','Edit Order successfull');
    }
    public function cancel_order($id){
        $order = Order::find($id);
        $order->status = 'cancel';
        $order->save();
        $new = new News();
        $new->order_code =$order->order_code;
        $new->link = $order->order_code;
        $new->send_admin = true;
        $new->title = "Cancel Order";
        $new->created_at=Carbon::now()->format('Y-m-d H:i:s');
        $new->save();
        return redirect()->back();
    }
    public function get_accountsetting(){
        return view('user.pages.About.setting');
    }
    public function post_editprofie(Request $req){
        $user = User::find(Auth::user()->id_user);
        $user->name = $req['new_name'];
        $checkEmail = User::where('email','=',$req['new_email'])->where('id_user','!=',Auth::user()->id_user)->get();
        if(count($checkEmail) == 0){
            $user->email = $req['new_email'];
        }else{
            return redirect()->back()->with('error','Error: Email has signed by another account');
        }
        $checkPhone = User::where('phone','=',$req['new_phone'])->where('id_user','!=',Auth::user()->id_user)->get();
        if(count($checkPhone) == 0){
            $user->phone = $req['new_phone'];
        }else{
            return redirect()->back()->with('error','Error: Email has signed by another account');
        }
        if(isset($req['changeImg']) && $req->hasFile('profie_image')){
            $file = $req->file('profie_image');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'webp'){
                return redirect()->back()->with('error','File image must be jpg,png,jpeg,webp');
            }
            $name=$file->getClientOriginalName();
            $num=0;
            $hinh = "user_".$num."_".$name;
            while(file_exists('images/avatar/'.$hinh)){
                $num++;
                $hinh = "user_".$num."_".$name;
            };
            $file->move('images/avatar/',$hinh);
            $user->avatar=$hinh;
        }
        $user->save();
        return redirect()->back()->with('message','Change profie successfully');
    }
    public function check_password(Request $req){
        $user = User::find(Auth::user()->id_user);
        if (Hash::check($req['current_password'], $user->password)) {
            echo "Accept";
        }else{
            echo "Incorrect password";
        }
    }
    public function post_changepassword(Request $req){
        $user = User::find(Auth::user()->id_user);
        $user->password = bcrypt($req['new_password']);
        $user->save();
        return redirect()->back()->with('message','Change Password successfully');
    }
    public function get_address(){
        return view('user.pages.About.address');
    }
    public function setdefault_address($id){
        foreach(Auth::user()->Address as $add){
            if($add->id_address != $id && $add->default ){
                $add->default = false;
                $add->save();
            }
        }
        $address = Address::where('id_user','=',Auth::user()->id_user)->where('id_address','=',$id)->first();
        $address->default = true;
        $address->save();
        return redirect()->back()->with('message','Change Default Address successfully');
    }
    public function get_payment(){
        return view('user.pages.About.payment');
    }
    public function get_feedback($code){
        $order = Order::where('order_code','=',$code)->first();
        return view('user.pages.Feedback.index',compact('order'));
    }
    public function post_feedback(Request $req,$code){
        foreach(Cart::where('order_code','=',$code)->get() as $cart){
            $new_commt = new Comment();
            $new_commt->id_user = Auth::user()->id_user;
            $new_commt->id_product = $cart->id_product;
            $new_commt->verified = true;
            $new_commt->rating = intval($req['rating_pro'.$cart->id_cart]);
            $new_commt->context= $req['content_fb'.$cart->id_cart];
            $new_commt->save();
        }
        $news = News::where('link','=','feedback')->where('attr','=',$code)->first();
        $news->delete();
        return redirect('/')->with('feedback_mess','Send feedback successfully');
    }
}
