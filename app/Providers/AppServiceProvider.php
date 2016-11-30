<?php

namespace App\Providers;

use App\Photo;
use Illuminate\Support\Facades\File;
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
        // event after the photo was deleted in the db
        Photo::deleted(function($photo) {
            File::delete(public_path() . $photo->file);
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
