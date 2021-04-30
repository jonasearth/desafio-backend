<?php

namespace Fnatic\Controllers\Admin;

use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Tools\Returns;
use Fnatic\Tools\Manipulador;

use Fnatic\Models\Admin;
use Fnatic\Services\Auth\AuthHandler;

class AdminLoginController
{
    static function login()
    {
        $admin =  Admin::where(function ($query) {
            $query->where('username', $_POST['username'])
                ->where('password', Manipulador::encryptPassword($_POST['password']));
        })->orWhere(function ($query) {
            $query->where('email', $_POST['username'])
                ->where('password', Manipulador::encryptPassword($_POST['password']));
        })
            ->take(1)
            ->get(['id', 'username', 'email']);
        if (count($admin) !== 1) {
            Returns::simpleMsgError(MessageErrorGlobal::INVALID_CRED);
        } else {
            Returns::msgData(MessageSuccessGlobal::LOGIN_SUCCESS, AuthHandler::createAdminToken($admin[0]));
        }
    }
}
