<?php

namespace Fnatic\Controllers\User;

use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Models\Moviment;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;

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

        $users =  self::findObj($route[2]['id']);
        if ($users) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, $users);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::NOT_RESULT_FOUND);
        }
    }
    public static function balance($route)
    {
        $balance = self::balanceObj($route[2]['id']);
        Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, ["balance" => floatval(number_format($balance, 2))]);
    }
    public static function balanceObj($id)
    {
        $user = self::findObj($id);
        if ($user->id == null) {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
        $moviments  = Moviment::where('idUser', '=', $id)->get();
        if ($moviments[0]->id == null) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, ["balance" => $user->balance]);
        }
        $balance = $user->balance;
        foreach ($moviments as $moviment) {
            if ($moviment->movimentType === "DEBIT") {
                $balance -= $moviment->value;
            } else {
                $balance += $moviment->value;
            }
        }
        return $balance;
    }

    public static function allObj()
    {
        $users =  User::orderBy('id', 'ASC')->get();
        return $users;
    }

    public static function findObj($id)
    {
        $users =  User::find($id);
        return $users;
    }
}
