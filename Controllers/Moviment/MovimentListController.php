<?php

namespace Fnatic\Controllers\Moviment;

use Error;
use Exception;
use Fnatic\Models\User;
use Fnatic\Tools\Returns;
use Fnatic\Models\Moviment;
use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Controllers\Moviment\MovimentConditionsController;
use Fnatic\Controllers\User\UserListController;
use Fnatic\Languages\PTBR\MessageError;
use Fnatic\Tools\Manipulador;

class MovimentListController
{

    public static function byUser($route)
    {
        $data = (object) [];
        $user = self::byUserObj($route[2]['idUser']);
        //verifica se o usuario existe
        if (!$user->id) {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }

        $pagination = MovimentUtilsController::getPaginationOffsetLimit();
        $moviments = Moviment::where('idUser', '=', $user->id)->skip($pagination[0])->take($pagination[1])->get();
        $data->user = $user;
        $data->moviments = $moviments;
        Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, $data);
    }

    /**
     * Obtem os Movimentos de um usuario
     * @return Object
     */
    public static function byUserObj($id)
    {
        return UserListController::findObj($id);
    }

    /**
     * verifica os dados de entrada e acina os metodos para construção do csv
     * @return void
     */
    public static function report($route)
    {

        $user = UserListController::findObj($route[2]['idUser']);

        if (!$user->id) {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::USER_NOT_FOUND);
        }


        if ($_POST['lastMonth'] === true) {
            $data = self::getLastMonthReport($route[2]['idUser']);
        } elseif (isset($_POST['date'])) {
            $data = self::getByMonthReport($route[2]['idUser'], $_POST['date']);
        } else {
            $data = Moviment::where('idUser', '=', $route[2]['idUser'])->get();
        }
        try {

            MovimentUtilsController::sendCsvFile($data, $user);
        } catch (Error $e) {
            http_response_code(404);

            Returns::simpleMsgError(MessageErrorGlobal::NOT_RESULT_FOUND);
        }
    }

    /**
     * Obtem os movimentos do ultimo mês
     * @return array
     */
    public static function getLastMonthReport($id)
    {
        $nowDate = date("Y-m-d");

        $startDate = date("Y-m-d", strtotime($nowDate) - (30 * 24 * 60 * 60));
        $nowDate = date("Y-m-d", strtotime($nowDate) + (1 * 24 * 60 * 60));
        return Moviment::where('idUser', '=', $id)->whereBetween("created_at", [$startDate, $nowDate])->get();
    }
    /**
     * Obtem os movimentos de um mês especifico
     * @return array
     */
    public static function getByMonthReport($id, $date)
    {
        $date = explode("/", $date);

        return Moviment::where('idUser', '=', $id)->whereMonth('created_at', $date[0])->whereYear('created_at', $date[1])->get();
    }
}
