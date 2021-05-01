<?php


namespace Fnatic\Controllers\Moviment;

use Fnatic\Models\User;
use Fnatic\Models\Moviment;

use Fnatic\Tools\Returns;

use Fnatic\Languages\MessageErrorGlobal;

class MovimentConditionsController
{
    /**
     * verifica as condições para criação de uma nova movimentação
     * @return array
     */
    public static function save($data)
    {
        //verifica se foi enviado o id do usuario
        if (!isset($data['idUser'])) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }
        $user = User::find($data['idUser']);
        //verifica se o usuario existe
        if (!$user->id) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }

        //verifica se o valor enviado é um numero
        if (!is_numeric($data['value']) || $data['value'] <= 0) {
            Returns::simpleMsgError(MessageErrorGlobal::MOVIMENT_VALUE_INVALID);
        }

        //verifica se o tipo de movimento é correto
        if ($data['movimentType'] !== Moviment::CREDIT && $data['movimentType'] !== Moviment::DEBIT && $data['movimentType'] !== Moviment::REFOUND) {
            Returns::simpleMsgError(MessageErrorGlobal::MOVIMENT_TYPE_INVALID);
        }

        return $data;
    }
}
