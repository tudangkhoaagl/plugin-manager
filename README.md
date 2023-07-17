# 1. Implement package to your project:
## 1.1 Create folder packages in your Laravel project

```├── packages
│   └── plugin-manager
│       └── ......
```

## 1.2 Add value in root composer.json

```
{
    ...,
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "repositories": [
        {
            "type": "path",
            "url": "packages/plugin-manager"
        }
    ],
    ...
}
```

## 1.3 Run command to install package

```
composer require dangkhoa/plugin-manager:dev-main
```

# 2. Create plugin folder inside the Plugins folder of package:

## 2.1 Structure of plugin:

```├── packages
│   └── plugin-manager
│       └── Plugins
│           └── {PluginName}
│               └── src
│                   └── Providers
│                       └── {PluginName}ServiceProvider.php
│               └── {PluginName}.yaml
│       └── ...
```

## 2.2 Create file yaml with structure:

### 2.2.1 Create file yaml with name <i>{PluginName}.yaml</i>

<p>You must declare the properties like this</p>

```
name: {name_of_plugin}
machine_name: {machine_name}
description: {description_of_plugin}
service_provider: Dangkhoa\Plugins\{PluginName}\src\Providers\{PluginName}ServiceProvider
```

### 2.2.2 Create Service provider for the plugin via the construct you declare in file yaml you created before

```
service_provider: Dangkhoa\Plugins\{PluginName}\src\Providers\{PluginName}ServiceProvider
```

<p>Inside the Provider must extend the base ServiceProvider and override the function of parent class.
<br>
Your service provider must register or boot some service to run code like purse Laravel
<br>
Example:
</p>

```
<?php

namespace Dangkhoa\Plugins\{plugin_name}\src\Providers;

use Illuminate\Support\ServiceProvider;

class {plugin_name}ServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Register config of plugin
        $this->mergeConfigFrom(__DIR__ . '/../../config/{name_file_config}.php', 'user_plugin');

        require_once __DIR__ . '/../Constant/{name_file_constant}.php';

        $this->registerRoute();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
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
```

<p>In example the RouteServiceProvider is override of root RouteServiceProvider of Laravel</p>

```
<?php

namespace Dangkhoa\Plugins\{plugin_name}\src\Providers;

use Dangkhoa\PluginManager\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(__DIR__ . '/../../routes/api.php');

            Route::middleware('web')
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }
}
```

# 3 Add Plugin Service provider to your Laravel code:

```
php artisan o:c
```
