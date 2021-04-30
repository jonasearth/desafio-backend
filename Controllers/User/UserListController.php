<?php

namespace Fnatic\Controllers\User;

use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Models\User;
use Fnatic\Tools\Returns;

class UserListController
{

    public static function all()
    {
        $users =  self::allObj();
        if (count($users) > 0) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, $users);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::NOT_RESULT_FOUND);
        }
    }

    public static function find($route)
    {

        $users =  self::findObj($route);
        if ($users) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, $users);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::NOT_RESULT_FOUND);
        }
    }

    public static function allObj()
    {
        $users =  User::orderBy('id', 'ASC')->get();
        return $users;
    }

    public static function findObj($route)
    {
        $users =  User::find($route[2]['id']);
        return $users;
    }
}
