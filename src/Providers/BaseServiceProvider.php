<?php

namespace Dangkhoa\PluginManager\Providers;

use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class BaseServiceProvider extends ServiceProvider
{
    protected static array $menus = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerMenu();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        ViewFacade::composer('plugin_manager::admin.layouts.partials.main_sidebar',function (View $view) {
            $view->with('menus', collect(self::$menus)->sortBy('priority'));
        });
    }

    /**
     * Register menu
     *
     * @param array|null $menus
     *
     * @return void
     */
    protected function registerMenu(?array $menus = []): void
    {
        self::$menus = [...self::$menus, ...$menus];
    }
}
