<?php

namespace Fnatic\Services\Auth;

use Exception;
use Firebase\JWT\JWT;
use Fnatic\Tools\Returns;

class AuthHandler implements IAuthHandler
{
    private const SECRET_ADMIN = "JKSJKS";

    /**
     * @auth JWT token
     * 
     * @return token:String
     * função para criação do token
     */
    static function createAdminToken($admin): string
    {
        $issuer_claim = "FNATIC"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $expire_claim = $issuedat_claim + 36000; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "exp" => $expire_claim,
            "data" => $admin
        );
        return JWT::encode($token, self::SECRET_ADMIN);
    }
    /**
     * 
     * 
     * @return admin:Object
     * verifica se o token é valido
     */
    static function verifyAdminToken()
    {
        // obtem o token do head do request
        $jwt = explode(" ", apache_request_headers()['Authorization']);

        if ($jwt[1]) {
            try {
                $decoded = JWT::decode($jwt[1], self::SECRET_ADMIN, array('HS256'));
                return $decoded;
            } catch (Exception $e) {
                http_response_code(403);
                Returns::simpleMsgError($e->getMessage());
            }
        } else {
            http_response_code(403);
            Returns::simpleMsgError("Token não enviado!");
        }
    }
}
