<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        Validator::extendImplicit('check_password', function ($attribute, $value, $parameters, $validator) {
            $valid = true;
            if (!empty($value)) {
                $user = Auth::user();
                if (!Hash::check($value, $user->password)) {
                    $valid = false;
                }
            }
            return $valid;
        });
        Validator::replacer('check_password', function ($message, $attribute, $rule, $parameters) {
            return 'Invalid Password';
        });
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
