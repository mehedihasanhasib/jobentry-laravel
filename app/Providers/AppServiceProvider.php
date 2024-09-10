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
            // personal
            "name" => "Name",
            "email" => "Email",
            "phone" => "Phone",
            "father_name" => "Father Name",
            "mother_name" => "Mother Name",
            "dob" => "Date of Birth",
            "gender" => "Gender",

            // education
            "degree" => "Degree",
            "exam" => "Exam",
            "institute" => "Institute",
            "passing_year" => "Passing Year",
            "group" => "Groub/Subject",
            "cgpa" => "CGPA",
            "scale" => "Scale",
        ];

        $types = [
            // personal
            "name" => "text",
            "email" => "email",
            "phone" => "tel",
            "father_name" => "text",
            "mother_name" => "text",
            "dob" => "date",
            "gender" => "select",

            // education
            "degree" => "text",
            "exam" => "text",
            "institute" => "text",
            "passing_year" => "text",
            "group" => "text",
            "cgpa" => "number",
            "scale" => "number",
        ];

        View::share('labels', $labels);
        View::share('types', $types);
    }
}
