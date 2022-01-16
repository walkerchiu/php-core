<?php

namespace WalkerChiu\Core;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();

        $this->app['router']->aliasMiddleware('wkCommon' , config('wk-core.class.core.commonMiddleware'));
        $this->app['router']->aliasMiddleware('wkPreventBackHistory' , config('wk-core.class.core.preventBackHistory'));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
           __DIR__ .'/config/core.php' => config_path('wk-core.php'),
        ], 'config');

        // Publish migration files
        $from = __DIR__ .'/database/migrations/';
        $to   = database_path('migrations') .'/';
        $this->publishes([
            $from .'create_wk_core_lang_table.php'
                => $to .date('Y_m_d_His', time()) .'_create_wk_core_lang_table.php',
            $from .'create_wk_core_log_table.php'
                => $to .date('Y_m_d_His', time()) .'_create_wk_core_log_table.php'
        ], 'migrations');

        // Publish translation files
        $this->loadTranslationsFrom(__DIR__.'/translations', 'php-core');
        $this->publishes([
            __DIR__.'/translations' => resource_path('lang/vendor/php-core'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                config('wk-core.command.cleaner'),
                config('wk-core.command.logCleaner')
            ]);
        }

        App::setLocale(config('app.locale'));

        config('wk-core.class.core.langCore')::observe(config('wk-core.class.core.langCoreObserver'));
        config('wk-core.class.core.log')::observe(config('wk-core.class.core.logObserver'));
        config('wk-core.class.core.logSearch')::observe(config('wk-core.class.core.logSearchObserver'));
        config('wk-core.class.core.logSys')::observe(config('wk-core.class.core.logSysObserver'));
    }

    /**
     * Merges user's and package's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        if (!config()->has('wk-core')) {
            $this->mergeConfigFrom(
                __DIR__ .'/config/core.php', 'wk-core'
            );
        }

        $this->mergeConfigFrom(
            __DIR__ .'/config/core.php', 'core'
        );
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param String  $path
     * @param String  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        if (
            !(
                $this->app instanceof CachesConfiguration
                && $this->app->configurationIsCached()
            )
        ) {
            $config = $this->app->make('config');
            $content = $config->get($key, []);

            $config->set($key, array_merge(
                require $path, $content
            ));
        }
    }
}
