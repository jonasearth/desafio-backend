<?php

namespace Fnatic\Routes\Tests;

use Fnatic\Tools\Returns;

class TestsRouter
{
    public static function start($r)
    {
        $r->addRoute('GET', '/welcome', function ($r) {
            http_response_code(418);
            Returns::simpleMsgError("Precisa de um café? Só precisamos de :", [
                "pó de café" => "algumas colheres",
                "agua" => "1l por pessoa deve dar...",
                "açucar" => "só pra quem gosta",
                "panela" => "das grandes de preferencia",
                "fogo" => "cuidado com a casa",
                "msg" => "boa jornada a todos nós!"
            ]);
        });
    }
}
