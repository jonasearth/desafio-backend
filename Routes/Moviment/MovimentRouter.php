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
                $r->addRoute('DELETE', '', function ($r) {
                    MovimentDeleteController::remove($r, AuthHandler::verifyAdminToken()->data);
                });
            });
            $r->addGroup('/user', function (\FastRoute\RouteCollector $r) {
                $r->addGroup('/{idUser:\d+}', function (\FastRoute\RouteCollector $r) {
                    $r->addRoute('GET', '', function ($r) {
                        MovimentListController::byUser($r, AuthHandler::verifyAdminToken()->data);
                    });
                    $r->addRoute('GET', '/report', function ($r) {
                        MovimentListController::report($r/*, AuthHandler::verifyAdminToken()->data*/);
                    });
                });
            });
        });
    }
}
