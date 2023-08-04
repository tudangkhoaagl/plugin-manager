<?php

use Dangkhoa\PluginManager\Enums\Plugin;

//Plugin status
if (! defined('PLUGIN_STATUS_ENABLE')) {
    define('PLUGIN_STATUS_ENABLE', Plugin::ACTIVE->value);
}

if (! defined('PLUGIN_STATUS_DISABLE')) {
    define('PLUGIN_STATUS_DISABLE', Plugin::DISABLE->value);
}

if (! defined('SUCCESS_MESSAGE')) {
    define('SUCCESS_MESSAGE', 'success_message');
}

if (! defined('ERROR_MESSAGE')) {
    define('ERROR_MESSAGE', 'error_message');
}

if (! defined('DATA_RESPONSE')) {
    define('DATA_RESPONSE', 'data');
}
