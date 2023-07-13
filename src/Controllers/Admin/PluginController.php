<?php

namespace Dangkhoa\PluginManager\Controllers\Admin;

use Dangkhoa\PluginManager\Actions\Plugins\Get as GetPlugins;
use Dangkhoa\PluginManager\Controllers\BaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PluginController extends BaseController
{
    public function __construct(
        protected GetPlugins $getPluginsAction
    ) {}

    /**
     * Summary of index
     *
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $plugins = $this->getPluginsAction->getAll();

        return view('plugin_manager::admin.plugin.index', compact('plugins'));
    }
}
