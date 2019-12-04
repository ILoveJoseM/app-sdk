<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019-12-03
 * Time: 18:08
 */

namespace JoseChan\App\Sdk\Providers;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use JoseChan\App\Sdk\AppSdk;

class AppSdkProvider extends ServiceProvider
{
    protected $defer = true;

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        parent::__construct($app);
    }

    public function boot()
    {
        $this->publishes([__DIR__.'/../../config/app.php' => config_path("app_sdk.php")]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $config = config("app_sdk");

        if(!$config){
            $config = include __DIR__.'/../../config/app.php';
        }

        $this->app->when(AppSdk::class)
            ->needs('$config')
            ->give($config);

    }

    
}