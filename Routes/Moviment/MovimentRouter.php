<?php

namespace Fnatic\Routes\Moviment;

use Fnatic\Services\Auth\AuthHandler;

use Fnatic\Controllers\Moviment\MovimentCreateController;
use Fnatic\Controllers\Moviment\MovimentDeleteController;
use Fnatic\Controllers\Moviment\MovimentListController;

class MovimentRouter
{
    public static function start($r)
    {
        $r->addGroup('/moviment', function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '', function ($r) {
                //MovimentListController::all($r, AuthHandler::verifyAdminToken()->data);
            });
            $r->addRoute('POST', '', function ($r) {
                MovimentCreateController::save($r, AuthHandler::verifyAdminToken()->data);
            });
            $r->addGroup('/{id:\d+}', function (\FastRoute\RouteCollector $r) {
                $r->addRoute('GET', '', function ($r) {
                    // MovimentListController::find($r, AuthHandler::verifyAdminToken()->data);
                });
                $r->addRoute('DELETE', '', function ($r) {
                    //  MovimentDeleteController::remove($r, AuthHandler::verifyAdminToken()->data);
                });
            });
        });
    }
}
