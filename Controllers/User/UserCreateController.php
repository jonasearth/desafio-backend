<?php

namespace Fnatic\Controllers\User;

use Exception;
use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Tools\Manipulador;

class UserCreateController
{
    public static function save()
    {
        $data = UserConditionsController::save($_POST);
        $user = User::create([
            "email" => $data['email'],
            "name" => $data['name'],
            "birthday" => Manipulador::convertDate($data['birthday']),
            "balance" => 1000, //valor inicial da abertuda da conta, não foi passado qual seria então coloquei um valor aleatorio
        ]);
        try {
            $user->save();
            Returns::msgData(MessageSuccessGlobal::USER_CREATED, $user);
        } catch (Exception $e) {
            Returns::simpleMsgError(MessageErrorGlobal::CREATE_ERROR);
        }
    }
}
