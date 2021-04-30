<?php


namespace Fnatic\Controllers\Moviment;

use Error;
use Fnatic\Controllers\User\UserListController;
use Fnatic\Languages\MessageErrorGlobal;


class MovimentUtilsController
{
    public static function getPaginationOffsetLimit()
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = intval($_GET['page']);
            if ($page <= 0) {
                $page = 1;
            }
        }
        $limit = 10;
        if (isset($_GET['limit'])) {
            $limit = intval($_GET['limit']);
            if ($limit <= 0) {
                $limit = 1;
            }
        }
        return [($page - 1) * $limit, $limit];
    }

    public static function sendCsvFile($data, $user)
    {
        $data = json_encode($data);
        $data = json_decode($data, true);
        $arrHead = ["id", "name", "birthday", "email", "balance", "balance after moviments"];
        $arrData = [$user->id, $user->name, $user->birthday, $user->email, $user->balance, UserListController::balanceObj($user->id)];
        if ($data == null) {
            throw new Error(MessageErrorGlobal::NOT_RESULT_FOUND);
            return;
        }
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=file.csv');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: no-cache');
        $out = fopen('php://output', 'w');
        fputcsv($out, $arrHead);
        fputcsv($out, $arrData);
        fputcsv($out, ['id', 'id User', 'moviment type', "value", "created at", "updated at"]);

        foreach ($data as $result) {
            fputcsv($out, $result);
        }
        fclose($out);
    }
}
