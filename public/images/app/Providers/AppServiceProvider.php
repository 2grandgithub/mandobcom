<?php

namespace App\Providers;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

      // \Schema::defaultStringLength(191);
 
                Blade::if('permission', function ($val) {
                  if (auth('Admin')->check())
                  {
                        if ( auth()->user()->super_admin ) {
                            return true;
                        }

                        foreach (auth()->user()->get_Role->get_Permissions as  $value)
                        {
                            if ($value->title == $val)
                            {
                                return true;
                            }
                        }
                        return false;
                   }
                   else { //if not admin
                     return false;
                   }
                });

                if (\App::getLocale() == 'en') {
                    \view()->share('mydir_custom', 'mydir_en');
                }
                else {
                    \view()->share('mydir_custom', 'mydir_ar');
                }



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
