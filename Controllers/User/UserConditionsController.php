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
    /**
     * Verifica condições para adicionar um novo usuario
     * @return array
     */
    public static function save($data)
    {
        $data = UserConditionsController::both($data);

        $user = User::where('email', $data['email'])->first();
        if ($user->id) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_ALREADY_EXIST);
        }
        return $data;
    }
    /**
     * Verifica condições para atualizar um usuario
     * @return array
     */
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
    /**
     * Verifica condições para excluir um usuario
     * @return array
     */
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

    /**
     * Verifica condições que são utilizadas por mais de uma função (save, update, delete)
     * @return array
     */
    public static function both($data)
    {
        //verifica se o client mandou o parametro name
        if (!isset($data['name'])) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NAME_LENGTH_ERROR);
        }
        //filtra o nome para apenas letras
        $data['name'] = Manipulador::accentedLetters($data['name']);

        //verifica se o o campo name tem o tamanho minimo adequado
        if (strlen($data['name']) < 5) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_NAME_LENGTH_ERROR);
        }

        //verifica se o email é valido
        if (!Manipulador::validEmail($data['email'])) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_EMAIL_INVALID);
        }

        //verifica se existe o parametro birthday
        if (!isset($data['birthday']) || strlen($data['birthday']) != 10) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_BIRTHDAY_LENGTH_ERROR);
        }

        //formata a data para uso
        $data['birthday'] = Manipulador::convertDate($data['birthday']);

        $dateBirth = new DateTime($data['birthday']);
        //calcula a diferença da data atual para data de nascimento
        $diff = $dateBirth->diff(new DateTime(date('Y-m-d')));

        //verifica se essa diferença é menor que 18 anos
        if ($diff->y < 18) {
            Returns::simpleMsgError(MessageErrorGlobal::USER_AGE_ERROR);
        }
        return $data;
    }
}
