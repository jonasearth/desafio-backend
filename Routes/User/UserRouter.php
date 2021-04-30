<?php

namespace Fnatic\Routes\User;

use Fnatic\Services\Auth\AuthHandler;

use Fnatic\Controllers\User\UserCreateController;
use Fnatic\Controllers\User\UserDeleteController;
use Fnatic\Controllers\User\UserListController;
use Fnatic\Controllers\User\UserUpdateController;

class UserRouter
{
    public static function start($r)
    {
        $r->addGroup('/user', function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '', function ($r) {
                UserListController::all($r, AuthHandler::verifyAdminToken()->data);
            });
            $r->addRoute('POST', '', function ($r) {
                UserCreateController::save($r, AuthHandler::verifyAdminToken()->data);
            });
            $r->addGroup('/{id:\d+}', function (\FastRoute\RouteCollector $r) {
                $r->addRoute('GET', '', function ($r) {
                    UserListController::find($r, AuthHandler::verifyAdminToken()->data);
                });
                $r->addRoute('PUT', '', function ($r) {
                    UserUpdateController::update($r, AuthHandler::verifyAdminToken()->data);
                });
                $r->addRoute('DELETE', '', function ($r) {
                    UserDeleteController::remove($r, AuthHandler::verifyAdminToken()->data);
                });
            });
        });
    }
}
