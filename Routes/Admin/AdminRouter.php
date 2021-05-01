<?php

namespace Fnatic\Routes\Admin;

use Fnatic\Controllers\Admin\AdminLoginController;


class AdminRouter
{
    public static function start($r)
    {
        $r->addGroup('/admin', function (\FastRoute\RouteCollector $r) {
            $r->addRoute('POST', '/login', function ($r) {
                AdminLoginController::login($r);
            });
        });
    }
}
