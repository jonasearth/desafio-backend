<?php

namespace Fnatic\Controllers\User;

use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Models\User;
use Fnatic\Tools\Returns;

class UserDeleteController
{
    public static function remove($route)
    {
        UserConditionsController::delete($route);
        $user = User::where('id', $route[2]['id'])->delete();
        if ($user) {
            Returns::msgData(MessageSuccessGlobal::USER_DELETED, []);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::DELETE_ERROR);
        }
    }
}
