<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            $this->mapGeneralRoutes();
            $this->mapAdminRoutes();
            $this->mapUserWebRoutes();
            $this->mapUserApiRoutes();
        });
    }

     /**
     * Call Admin Routes
     */
    protected function mapAdminRoutes()
    {
        $webFiles = glob(base_path('routes/Admin/*.php'));
        for ($i = 0; $i < count($webFiles); $i++) {
            Route::prefix('admin/')
                ->middleware('auth:admin')
                ->group($webFiles[$i]);
        }
    }


    /**
     * Call User Api Routes
     */
    protected function mapUserApiRoutes()
    {
        $webFiles = glob(base_path('routes/User/Api/*.php'));
        for ($i = 0; $i < count($webFiles); $i++) {
            Route::prefix('api/user/')
                ->middleware('auth:api')
                ->group($webFiles[$i]);
        }
    }

     /**
     * Call User Web Routes
     */
    protected function mapUserWebRoutes()
    {
        $webFiles = glob(base_path('routes/User/Web/*.php'));
        for ($i = 0; $i < count($webFiles); $i++) {
            Route::prefix('user/')
                ->middleware('auth')
                ->group($webFiles[$i]);
        }
    }

    /**
     * Call General Routes.
     */
    protected function mapGeneralRoutes()
    {
        Route::prefix('api')->group(base_path('routes/api.php'));
        Route::prefix('')->middleware('web')->group(base_path('routes/web.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
