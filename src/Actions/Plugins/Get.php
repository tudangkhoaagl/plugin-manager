<?php

namespace Dangkhoa\PluginManager\Actions\Plugins;

use Dangkhoa\PluginManager\Models\Plugin;

class Get
{
    /**
     * Summary of __construct
     *
     * @param Plugin $plugin
     */
    public function __construct(
        protected Plugin $model
    ) {

    }

    public function getAll()
    {
        return $this->model->query()->paginate(10);
    }
}
