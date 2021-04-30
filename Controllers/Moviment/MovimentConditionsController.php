<?php


namespace Fnatic\Controllers\Moviment;

use Fnatic\Models\User;
use Fnatic\Models\Moviment;

use Fnatic\Tools\Returns;

use Fnatic\Languages\MessageErrorGlobal;

class MovimentConditionsController
{
    public static function save($data)
    {
        if (!isset($data['idUser'])) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
        $user = User::find($data['idUser']);
        if (!$user->id) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }

        if (!is_numeric($data['value']) || $data['value'] <= 0) {
            Returns::simpleMsgError(MessageErrorGlobal::MOVIMENT_VALUE_INVALID);
        }
        if ($data['movimentType'] !== Moviment::CREDIT && $data['movimentType'] !== Moviment::DEBIT && $data['movimentType'] !== Moviment::REFOUND) {
            Returns::simpleMsgError(MessageErrorGlobal::MOVIMENT_TYPE_INVALID);
        }

        return $data;
    }

    public static function delete($route)
    {

        //return $data;
    }
}
