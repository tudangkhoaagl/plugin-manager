<?php

namespace Dangkhoa\PluginManager\Actions;

use Illuminate\Database\Eloquent\Model;

abstract class BaseAction implements BaseActionInterface
{
    protected $model;

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Summary of getModel
     *
     * @return string
     */
    protected abstract function getModel(): string;

    /**
     * Summary of setModel
     *
     * @return void
     */
    public function setModel(): void
    {
        $this->model = $this->model = app()->make(
            $this->getModel()
        );
    }
}
