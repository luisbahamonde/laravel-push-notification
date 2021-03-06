<?php namespace Davibennun\LaravelPushNotification;

use Illuminate\Support\ServiceProvider;
use Davibennun\LaravelPushNotification\PushNotification;

class LaravelPushNotificationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $configPath = $this->app->make('path.config');

        $this->publishes([
            __DIR__ . '/../Config/config.php' => $configPath . '/push-notification.php',
        ], 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {

        $this->app->singleton('PushNotification', function ($app) {
            return new PushNotification();
        });

        $this->app->bind(PushNotification::class, 'PushNotification');
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            PushNotification::class,
            'PushNotification',
        ];
    }

}
