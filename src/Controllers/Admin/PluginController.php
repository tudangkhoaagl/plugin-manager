<?php

namespace Dangkhoa\PluginManager\Controllers\Admin;

use Dangkhoa\PluginManager\Actions\Plugin\Get as GetPlugins;
use Dangkhoa\PluginManager\Controllers\BaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PluginController extends BaseController
{
    /**
     * Summary of __construct
     *
     * @param GetPlugins $getPluginsAction
     */
    public function __construct(
        protected GetPlugins $getPluginsAction
    ) {
        
    }

    /**
     * Summary of index
     *
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $plugins = $this->getPluginsAction->sortPluginInByCondition();

        return view('plugin_manager::admin.plugin.index', compact('plugins'));
    }
}
