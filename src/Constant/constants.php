<?php

use Dangkhoa\PluginManager\Enums\Plugin;

//Plugin status
if (! defined('PLUGIN_STATUS_ENABLE')) {
    define('PLUGIN_STATUS_ENABLE', Plugin::ACTIVE->value);
}

if (! defined('PLUGIN_STATUS_DISABLE')) {
    define('PLUGIN_STATUS_DISABLE', Plugin::DISABLE->value);
}
