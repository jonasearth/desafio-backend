<?php

namespace Fnatic\Controllers\User;

use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Tools\Manipulador;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;

class UserUpdateController
{
    static function update($route)
    {

        $data = UserConditionsController::update($_POST, $route);
        $user = User::where('id', $route[2]['id'])
            ->update([
                "email" => $data['email'],
                "name" => $data['name'],
                "birthday" => $data['birthday'],
            ]);
        if ($user) {
            Returns::msgData(MessageSuccessGlobal::USER_UPDATED);
        } else {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
    }

    static function updateBalance($route)
    {
        $balance =  floatval($_POST['balance']);
        $user = User::where('id', $route[2]['id'])
            ->update([
                "balance" => $balance
            ]);
        if ($user) {
            Returns::msgData(MessageSuccessGlobal::USER_UPDATED);
        } else {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
    }
}
