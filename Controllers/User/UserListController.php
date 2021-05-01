<?php

namespace Fnatic\Controllers\User;

use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Models\Moviment;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;

class UserListController
{
    /**
     * 
     * @return void
     */
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
    /**
     * 
     * @return void
     */
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
    /**
     * @return void
     */
    public static function balance($route)
    {
        $balance = self::balanceObj($route[2]['id']);
        Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, ["balance" => floatval(number_format($balance, 2))]);
    }

    /**
     * Obtem o saldo do usuario pelo seu id (com as movimentações calculadas)
     * @return void
     */
    public static function balanceObj($id)
    {
        //busca o usuario
        $user = self::findObj($id);
        //verifica se há esse usuario
        if ($user->id == null) {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
        //obtem as movimentações desse usuario
        $moviments  = Moviment::where('idUser', '=', $id)->get();
        //verifica se existe movimentações
        if ($moviments[0]->id == null) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, ["balance" => $user->balance]);
        }
        $balance = $user->balance;
        //percorre as movimentações somando ou subtraindo de acordo com seu tipo
        foreach ($moviments as $moviment) {
            if ($moviment->movimentType === "DEBIT") {
                $balance -= $moviment->value;
            } else {
                $balance += $moviment->value;
            }
        }
        return $balance;
    }
    /**
     * Obtem todos os usuarios
     * @return Object[]
     */
    public static function allObj()
    {
        $users =  User::orderBy('id', 'ASC')->get();
        return $users;
    }

    /**
     * Obtem um usuario pelo seu id
     * @return Object
     */
    public static function findObj($id)
    {
        $users =  User::find($id);
        return $users;
    }
}
