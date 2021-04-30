<?php


namespace Fnatic\Controllers\User;

use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Tools\Manipulador;
use Fnatic\Languages\MessageErrorGlobal;

class UserConditionsController
{
    public static function save($data)
    {
        $data = UserConditionsController::both($data);

        $user = User::where('email', $data['email'])->first();
        if ($user->id) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_ALREADY_EXIST);
        }
        return $data;
    }
    public static function update($data, $route)
    {
        $data = UserConditionsController::both($data);

        $seller = User::where(
            [
                ['email', "=", $data['email']],
                ['id', "!=",  $route[2]['id']]
            ]
        )->first();
        if ($seller->id)
            Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_ALREADY_EXIST);
        return $data;
    }
    public static function delete($route)
    {

        //return $data;
    }

    public static function both($data)
    {
        $data['name'] = Manipulador::accentedLetters($data['name']);
        if (!isset($data['name']) || strlen($data['name']) < 5) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NAME_LENGTH_ERROR);
        }
        if (!Manipulador::validEmail($data['email'])) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_INVALID);
        }
        if (!isset($data['birthday']) || strlen($data['birthday']) != 10) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_BIRTHDAY_LENGTH_ERROR);
        }

        return $data;
    }
}
