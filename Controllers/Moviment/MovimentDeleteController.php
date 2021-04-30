<?php

namespace Fnatic\Controllers\Moviment;

use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Models\Moviment;
use Fnatic\Tools\Returns;

class MovimentDeleteController
{
    public static function remove($route)
    {
        MovimentConditionsController::delete($route);
        $moviment = Moviment::where('id', $route[2]['id'])->delete();
        if ($moviment) {
            Returns::msgData(MessageSuccessGlobal::MOVIMENT_DELETED, []);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::DELETE_ERROR);
        }
    }
}