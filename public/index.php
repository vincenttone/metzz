<?php
require_once(dirname(dirname(__FILE__)) . '/init.php');
Metz\app\metz\Router::get_instance()->load_configure(Metz\configure\Route::configure());
Metz\sys\Router::get_instance()
    ->register_router([Metz\app\metz\Router::get_instance(), 'route'])
    ->dispatch();