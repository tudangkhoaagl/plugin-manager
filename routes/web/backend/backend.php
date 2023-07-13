<?php

use Dangkhoa\PluginManager\Controllers\Admin\PluginController;
use Illuminate\Support\Facades\Route;

Route::name('backend.')->group(function () {
    Route::get('plugins', [PluginController::class, 'index']);
});
