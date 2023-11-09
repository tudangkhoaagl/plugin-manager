<?php

namespace Dangkhoa\PluginManager\Actions\Plugin;

use Dangkhoa\PluginManager\Models\Plugin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Get
{
    /**
     * Invoke Get Plugins
     *
     * @return LengthAwarePaginator
     */
    public function __invoke(): LengthAwarePaginator
    {
        return Plugin::query()->paginate(10);
    }
}
