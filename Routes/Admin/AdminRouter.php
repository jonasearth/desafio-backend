<?php

namespace Fnatic\Routes\Admin;

use Fnatic\Services\Auth\AuthHandler;
use Fnatic\Controllers\Admin\AdminListController;
use Fnatic\Controllers\Admin\AdminLoginController;


class AdminRouter
{

    public static function start($r)
    {
        $r->addGroup('/admin', function (\FastRoute\RouteCollector $r) {
            $r->addRoute('POST', '/login', function ($r) {
                AdminLoginController::login($r);
            });
            $r->addRoute('GET', '', function ($r) {;
                AdminListController::me($r, AuthHandler::verifyAdminToken()->data);
            });
        });
    }
}
