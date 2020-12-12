<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->limitRateForRoutes();
        $this->registerRoutes();
    }

    /**
     * Limit request rate for routes.
     *
     * @return void
     */
    protected function limitRateForRoutes(): void
    {
        $this->rateLimitApi();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function rateLimitApi(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $this->getRateLimitIdentity($request)
            );
        });
    }

    /**
     * Register routes for application.
     *
     * @return void
     */
    protected function registerRoutes(): void
    {
        $this->routes(function () {
            $this->routesForApi();
            $this->routesForDashboard();
            $this->routesForWeb();
        });
    }

    /**
     * Register routes for API.
     *
     * @return void
     */
    protected function routesForApi(): void
    {
        Route::prefix('api')
            ->name('api.')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }

    /**
     * Register routes for dashboard.
     *
     * @return void
     */
    protected function routesForDashboard(): void
    {
        Route::prefix('dashboard')
            ->name('dashboard.')
            ->middleware('web')
            ->group(base_path('routes/dashboard.php'));
    }

    /**
     * Register for routes for web.
     *
     * @return void
     */
    protected function routesForWeb(): void
    {
        Route::prefix('')
            ->name('web.')
            ->middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * Get rate limit user identity.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    private function getRateLimitIdentity(Request $request): ?string
    {
        return optional($request->user())->id ?: $request->ip();
    }
}
