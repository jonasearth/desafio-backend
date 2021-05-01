<?php


namespace Fnatic\Controllers\Moviment;

use Error;
use Fnatic\Controllers\User\UserListController;
use Fnatic\Languages\MessageErrorGlobal;


class MovimentUtilsController
{
    //retorna os parametros para a paginação funcionar corretamente
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

    //monta o cabeçalho e o csv para download
    public static function sendCsvFile($data, $user)
    {
        //transforma object em array
        $data = json_encode($data);
        $data = json_decode($data, true);

        //adiciona o cabeçalho do csv
        $arrHead = ["id", "name", "birthday", "email", "balance", "balance after moviments"];

        //adiciona as informações do cliente no cabeçalho
        $arrData = [$user->id, $user->name, $user->birthday, $user->email, $user->balance, UserListController::balanceObj($user->id)];

        //verifica se há dados para exibir
        if ($data == null) {
            throw new Error(MessageErrorGlobal::NOT_RESULT_FOUND);
            return;
        }

        //monta o head da requisição
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=file.csv');
        header('Content-Transfer-Encoding: binary');
        header('Pragma: no-cache');

        //abre a escrita do arquivo
        $out = fopen('php://output', 'w');

        //adiciona o cabeçalho na saida 
        fputcsv($out, $arrHead);

        //adiciona os dados do usuario 
        fputcsv($out, $arrData);
        //adiciona um cabeçalho para os dados
        fputcsv($out, ['id', 'id User', 'moviment type', "value", "created at", "updated at"]);

        //percorre os dados adicionando cada linha ao arquivo
        foreach ($data as $result) {
            fputcsv($out, $result);
        }
        //finaliza a escrita
        fclose($out);
    }
}
