<?php

namespace App\Providers;

use App\Services\MediaGenerator\Contracts\Service as ServiceContract;
use App\Services\MediaGenerator\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class MediaGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindService();
    }

    protected function bindService(): void
    {
        $this->app->bind(ServiceContract::class, function () {
            return new Service(
                new \Illuminate\Config\Repository(
                    config('media-generator', [])
                ),
                new \App\Services\MediaGenerator\Assets(
                    Storage::disk(
                        config('media-generator.disk', 'local')
                    )
                )
            );
        });
    }
}
