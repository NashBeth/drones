<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;




class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(Setting::class, function ($app) {
            return new Setting($app);
        });
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Setting', Setting::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // only use the Settings package if the Settings table is present in the database
        try {
            if (!\App()::runningInConsole() && count(Schema::getColumnListing('settings'))) {
                $settings = Setting::all();
                foreach ($settings as $key => $setting) {
                    Config::set('settings.' . $setting->key, $setting->value);
                }
            }
        } catch (\Exception $e) {
            // do nothing
        }
    }
}
