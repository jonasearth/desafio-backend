<?php

namespace Fnatic\Controllers\Moviment;

use Exception;
use Fnatic\Tools\Returns;
use Fnatic\Models\Moviment;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Controllers\Moviment\MovimentConditionsController;

class MovimentCreateController
{
    /**
     * Adiciona uma nova movimentação a um usuario
     * @return void
     * */
    public static function save()
    {
        $data = MovimentConditionsController::save($_POST);

        $moviment = Moviment::create([
            "idUser" => $data['idUser'],
            "movimentType" => $data['movimentType'],
            "value" => $data['value'],
        ]);
        try {
            $moviment->save();
            Returns::msgData(MessageSuccessGlobal::MOVIMENT_CREATED, $moviment);
        } catch (Exception $e) {
            Returns::simpleMsgError(MessageErrorGlobal::CREATE_ERROR);
        }
    }
}
