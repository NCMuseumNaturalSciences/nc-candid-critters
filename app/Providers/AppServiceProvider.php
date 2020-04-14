<?php

namespace App\Providers;

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
/*
	    Bugsnag::registerCallback(function ($report) {
		    $report->setMetaData([
		        'account' => [
		            'name' => 'Acme Co.',
		            'paying_customer' => true,
		        ]
		    ]);
		});
		*/
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('bugsnag.multi', \Illuminate\Contracts\Logging\Log::class);
		$this->app->alias('bugsnag.multi', \Psr\Log\LoggerInterface::class);
    }
}
