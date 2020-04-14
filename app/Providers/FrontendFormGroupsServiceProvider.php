<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FrontendFormGroupsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('textGroup', 'components.forms.text', ['params','errors']);
        Form::component('cbGroup', 'components.forms.checkbox', ['params','errors']);
        Form::component('rbGroup', 'components.forms.radiobutton', ['params','errors']);
        Form::component('ynGroup', 'components.forms.yn-radiobutton', ['params','errors']);
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
