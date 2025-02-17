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
    /**
     * Cria um novo usuario
     * @return void
     */
    public static function save()
    {
        $data = UserConditionsController::save($_POST);
        $user = User::create([
            "email" => $data['email'],
            "name" => $data['name'],
            "birthday" => $data['birthday'],
        ]);
        try {
            $user->save();
            Returns::msgData(MessageSuccessGlobal::USER_CREATED, $user);
        } catch (Exception $e) {
            Returns::simpleMsgError(MessageErrorGlobal::CREATE_ERROR);
        }
    }
}
