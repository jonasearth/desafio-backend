<?php


namespace Fnatic\Controllers\User;

use DateTime;
use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Models\Moviment;
use Fnatic\Tools\Manipulador;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Controllers\Moviment\MovimentListController;

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

            http_response_code(400);
        Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_ALREADY_EXIST);
        return $data;
    }
    public static function delete($route)
    {
        $user = UserListController::findObj($route[2]['id']);
        if ($user->id != null) {

            if ($user->balance !== "0.00") {

                http_response_code(400);
                Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_DELETE_BALANCE_ERROR);
            }
            $data = Moviment::where('idUser', '=', $user->id)->get();
            if ($data[0]->id != null) {

                http_response_code(400);
                Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_DELETE_BALANCE_ERROR);
            }
        }
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

        $data['birthday'] = Manipulador::convertDate($data['birthday']);

        $dateBirth = new DateTime($data['birthday']);
        $diff = $dateBirth->diff(new DateTime(date('Y-m-d')));

        if ($diff->y < 18) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_AGE_ERROR);
        }
        return $data;
    }
}
