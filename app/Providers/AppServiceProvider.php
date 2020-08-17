<?php

namespace App\Providers;

use App\Sequence;
use App\Setting;
use App\Term;
use App\Year;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $year = Year::where('active', 1)->first();
        $setting = Setting::where('year_id', $year->id)->first();
        $current_term = Term::where('active', 1)->first();
        $current_sequence = Sequence::where('active', 1)->first();
        View::share(['current_year' => $year, 'setting' => $setting, 'current_term' => $current_term, 'current_sequence' => $current_sequence]);
    }
}
