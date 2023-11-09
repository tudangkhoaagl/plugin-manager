<?php

namespace Dangkhoa\PluginManager\Http\Controllers\Admin;

use Dangkhoa\PluginManager\Actions\Plugin\Get as GetPlugins;
use Dangkhoa\PluginManager\Http\Controllers\BaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PluginController extends BaseController
{
    /**
     * Index
     *
     * @param GetPlugins $getPlugin
     *
     * @return Factory|View
     */
    public function index(GetPlugins $getPlugin): Factory|View
    {
        return view('plugin_manager::admin.plugin.index', ['plugins' => $getPlugin()]);
    }
}
