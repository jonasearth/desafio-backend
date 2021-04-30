<?php

namespace Fnatic\Controllers\Admin;

use Fnatic\Languages\MessageErrorGlobal;
use Fnatic\Languages\MessageSuccessGlobal;
use Fnatic\Models\Admin;
use Fnatic\Tools\Returns;

class AdminListController
{

    public static function me($r, $admin)
    {

        $admins =  Admin::find($admin->id)
            ->get(["id", "name", "email", "username", "created_at", "updated_at"]);
        if ($admins) {
            Returns::msgData(MessageSuccessGlobal::RESULT_FOUND, $admins);
        } else {
            http_response_code(404);
            Returns::simpleMsgError(MessageErrorGlobal::NOT_RESULT_FOUND);
        }
    }
}
