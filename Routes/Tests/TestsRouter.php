<?php

namespace Fnatic\Routes\Tests;

use Fnatic\Tests\ReplaceTest;

class TestsRouter
{

    public static function start($r)
    {
        $r->addGroup('/test', function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '', function ($r) {


                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename=file.csv');
                header('Content-Transfer-Encoding: binary');
                header('Pragma: no-cache');

                $results = [
                    [
                        "nome" => 'jonas',
                        "mov" => "credit",
                        "value" => "10000"
                    ],
                    [
                        "nome" => 'jonas',
                        "mov" => "credit",
                        "value" => "20000"
                    ],
                    [
                        "nome" => 'jonas',
                        "mov" => "credit",
                        "value" => "30000"
                    ],
                    [
                        "nome" => 'jonas',
                        "mov" => "credit",
                        "value" => "40000"
                    ],
                    [
                        "nome" => 'jonas',
                        "mov" => "credit",
                        "value" => "50000"
                    ],
                ];

                $out = fopen('php://output', 'w');
                foreach ($results as $result) {
                    fputcsv($out, $result);
                }
                fclose($out);
            });
        });
    }
}
