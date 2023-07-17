<?php

namespace Dangkhoa\PluginManager\Providers;

use Dangkhoa\PluginManager\Console\Commands\PluginManagerMigration;
use Exception;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

class PluginManagerServiceProvider extends ServiceProvider
{
    /**
     * Summary of providers
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Summary of aliases
     *
     * @var array
     */
    protected $aliases = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register config of package
        $this->mergeConfigFrom(__DIR__ . '/../../config/package_config.php', 'plugin_manager');

        require_once __DIR__ . '/../Constant/constants.php';

        // Register alias for packge
        $loader = AliasLoader::getInstance();
        $loader->alias('Yaml', Yaml::class);

        $this->getYamlFile();

        $this->registerProviders();

        $this->registerRoute();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Register asset public
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugin_manager');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'plugin_manager');

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        // Publish tag
        $this->publishes([
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/plugin_manager'),
        ], 'plugin_manager-lang');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/plugin_manager'),
        ], 'plugin_manager_views');

        $this->publishes([
            __DIR__ . '/../../database/migrations' => resource_path('migrations/vendor/plugin_manager'),
        ], 'plugin_manager_migration');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/plugin_manager'),
        ], 'plugin_manager_public');

        $this->publishes([
            __DIR__ . '/../../config/package_config.php' => config_path('package_config.php'),
        ], 'plugin_manager_config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PluginManagerMigration::class,
            ]);
        }
    }

    /**
     * Summary of registerProvoiders
     *
     * @return void
     */
    protected function registerProviders(): void
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Summary of registerAliases
     *
     * @return void
     */
    protected function registerAliases(): void
    {
        if (isset($this->aliases[$this->app->environment()])) {
            foreach ($this->aliases[$this->app->environment()] as $alias => $abstract) {
                $this->app->alias($abstract, $alias);
            }
        }
    }

    /**
     * Summary of getYamlFile
     *
     * @return void
     */
    protected function getYamlFile(): void
    {
        $plugins = array_filter(scandir(__DIR__ . "/../../Plugins/", 1), function ($value) {
            return $value !== '.' && $value !== '..';
        });

        if (count($plugins) < 1) {
            return;
        }

        foreach ($plugins as $plugin) {
            if (! is_dir('/../../Plugins/' . $plugin)) {
                continue;
            }

            $yamlContents = Yaml::parse(file_get_contents(__DIR__ . '/../../Plugins/' . $plugin . '/' . strtolower($plugin) . '.yaml'));
            if (
                count($yamlContents) < 1
                || (
                    empty($yamlContents['name'])
                    && empty($yamlContents['machine_name'])
                    && empty($yamlContents['service_provider'])
                )
            ) {
                continue;
            }

            if (! $machine = DB::table('plugins')->where('machine_name', $yamlContents['machine_name'])->first()) {
                DB::table('plugins')->insert([
                    'name' => $yamlContents['name'],
                    'machine_name' => $yamlContents['machine_name'],
                    'provider' => $yamlContents['service_provider'],
                    'description' => $yamlContents['description'] ?? '',
                    'priovity' => DB::table('plugins')->count() > 0 ? DB::table('plugins')->latest()->first()->priovity + 1 : 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('plugins')->where('machine_name', $yamlContents['machine_name'])->update([
                    'name' => $yamlContents['name'],
                    'machine_name' => $yamlContents['machine_name'],
                    'provider' => $yamlContents['service_provider'],
                    'description' => $yamlContents['description'] ?? '',
                    'priovity' => DB::table('plugins')->count() > 0 ? DB::table('plugins')->latest()->first()->priovity + 1 : 1,
                    'updated_at' => now(),
                ]);

                $machine = DB::table('plugins')->where('machine_name', $yamlContents['machine_name'])->first();
            }

            if (
                $machine
                && $machine->status === PLUGIN_STATUS_ENABLE
            ) {
                $this->providers[] = $yamlContents['service_provider'];
            }
        }
    }

    /**
     * Register route for plugin
     *
     * @return void
     */
    public function registerRoute(): void
    {
        if (class_exists(RouteServiceProvider::class)) {
            $this->app->register(RouteServiceProvider::class);
        }
    }
}
