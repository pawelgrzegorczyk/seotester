<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapMainRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'domain' => '{projectName}.web.'.config('app.url'),
            'middleware' => 'web',
            'namespace' => $this->namespace."\Web",
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'domain' => 'api.'.config('app.url'),
            'middleware' => 'api',
            'namespace' => $this->namespace."\Api",
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }


    protected function mapAdminRoutes()
    {
        Route::group([
            'domain' => 'admin.'.config('app.url'),
            'middleware' => 'web',
            'namespace' => $this->namespace."\Admin",

        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }


    protected function mapMainRoutes()
    {
        Route::group([
            'domain' => config('app.url'),
            'middleware' => 'web',
            'namespace' => $this->namespace."\Main",

        ], function ($router) {
            require base_path('routes/main.php');
        });
    }

}
