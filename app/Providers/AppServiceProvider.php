<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('random',function(){
            $colors = ['info','default','primary','success','danger','warning'];
           return '<?php echo "'.$colors[array_rand($colors)].'" ?>';
        });
//        if(!$this->app->runningInConsole()) {
//            $admins = Admin::all();
//            View::share('all_admin', $admins);
//        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
