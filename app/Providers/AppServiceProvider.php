<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $labels = [
            "name" => "Name",
            "email" => "Email",
            "phone" => "Phone",
            "father_name" => "Father Name",
            "mother_name" => "Mother Name",
            "dob" => "Date of Birth",
            "gender" => "Gender",
        ];
        $types = [
            "name" => "text",
            "email" => "email",
            "phone" => "tel",
            "father_name" => "text",
            "mother_name" => "text",
            "dob" => "date",
            "gender" => "select",
        ];

        // View::share();
        View::share('labels', $labels);
        View::share('types', $types);
    }
}
