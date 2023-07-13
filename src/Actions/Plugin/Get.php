<?php

namespace Dangkhoa\PluginManager\Actions\Plugin;

use Dangkhoa\PluginManager\Models\Plugin as PluginModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class Get
{
    CONST PAGINATION = 10;

    /**
     * Summary of __construct
     * @param PluginModel $model
     */
    public function __construct(
        protected PluginModel $model
    ) {

    }

    /**
     * Summary of sortPluginInByCondition
     * @param array $data
     * @param mixed $paginate
     * @return LengthAwarePaginator|Collection|array
     */
    public function sortPluginInByCondition(array $data = [], $paginate = self::PAGINATION): LengthAwarePaginator|Collection|array
    {
        $query = $this->model->query();

        if ($paginate) {
            return $query->paginate($paginate);
        }

        return $query->get();
    }
}
