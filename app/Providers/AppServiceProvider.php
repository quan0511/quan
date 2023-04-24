<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Groupmessage;
use App\Models\Message;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('user.partials.header',function($view){
            if(Auth::check()){
                $news = News::where('send_admin', '=', false)->where(function (Builder $query) {
                                                                        $query->where('id_user', '=', Auth::user()->id_user)
                                                                              ->orWhere('id_user', '=', null);
                                                                    })->get();
                $view->with('news',$news);
            }
	    });
    }
}
