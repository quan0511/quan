<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        try{

            $google_user = Socialite::driver('google')->user();
            
            // dd($google_user);
            $user = User::where('google_id','=',$google_user->getId())->orWhere('email','=',$google_user->getEmail())->first();
            if(!$user){
                $new_user = new User();
                $new_user->name = $google_user->getName();
                $new_user->email =$google_user->getEmail();
                $new_user->google_id = $google_user->getId();
                if($google_user->getAvatar()){
                    $file = file_get_contents($google_user->getAvatar());
                    File::put("images/avatar/gguser_".$google_user->getId().".jpg",$file);
                    $new_user->avatar = "gguser_".$google_user->getId().".jpg";
                }
                $new_user->email_verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $new_user->created_at = Carbon::now()->format('Y-m-d H:i:s');
                $new_user->save();
                if(Session::has("cart")){
                    $cart_session = Session::get("cart");
                    $user = User::where('google_id','=',$google_user->getId())->first();
                    foreach($cart_session as $key => $value){
                        $addToUserCart = new Cart();
                        $addToUserCart->id_user = $user->id_user;
                        $addToUserCart->id_product = $value["id_product"];
                        $addToUserCart->amount = $value["amount"];
                        $addToUserCart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                        $addToUserCart->save();
                    }
                    Session::forget("cart");
                };
                Auth::login($new_user);
                return redirect('/');
            }else{
                if(Session::has("cart")){
                    $cart_session = Session::get("cart");
                    foreach($cart_session as $key => $value){
                        $foundPro = $user->Cart->where('id_product','=',$value["id_product"])->first();
                        if($foundPro != null){
                            if(($foundPro->amount + $value["amount"]) >= $value['max']){
                                $foundPro->amount = $user->Cart->where('id_product','=',$value["id_product"])->first()->Product->quantity;
                            }else{
                                $foundPro->amountt += $value["amount"];
                            };
                            $foundPro->save();
                        }else{
                            $addToUserCart = new Cart();
                            $addToUserCart->id_user = $user->id_user;
                            $addToUserCart->id_product = $value["id_product"];
                            $addToUserCart->amount = $value["amount"];
                            $addToUserCart->created_at = Carbon::now()->format('Y-m-d H:i:s');
                            $addToUserCart->save();
                        }
                    }
                    Session::forget("cart");
                };
                Auth::login($user);
                return redirect('/');
            }
        }catch(\Throwable $th){
            dd($th);
        }
    }
}
