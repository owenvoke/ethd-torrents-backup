<?php

namespace pxgamer\EtHD_Torrents\Routing;

use System\App;
use System\Request;
use System\Route;

/**
 * Class Router
 */
class Router
{
    public function __construct()
    {
        $app = App::instance();
        $app->request = Request::instance();
        $app->route = Route::instance($app->request);
        $route = $app->route;

        // Main
        $route->any('/', ['pxgamer\EtHD_Torrents\Modules\Base\Controller', 'index']);
        $route->any('/search', ['pxgamer\EtHD_Torrents\Modules\Torrents\Controller', 'search']);

        // Cron
        $route->any('/cron', ['pxgamer\EtHD_Torrents\Modules\Torrents\Controller', 'cron']);

        // Route fallback for page not found
        $route->any('/*', ['pxgamer\EtHD_Torrents\Modules\Base\Controller', 'errorNotFound']);

        $route->end();
    }

    public static function redirect($location = '/')
    {
        if (!headers_sent()) {
            header('Location: ' . $location);
        }
    }
}
