<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;
class AdminFormGroupsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel Collective Custom Components
        // Set default value (null): 'value' => null
        Form::component('ccText', 'admin.components.forms.text', ['name', 'label', 'value' => null, 'attributes' => []]);
        Form::component('ccYN', 'admin.components.forms.yn', ['name', 'label', 'value' => null, 'attributes'=> []]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
