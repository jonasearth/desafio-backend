<?php

namespace Fnatic\Tools;

class Manipulador
{
    public static function encryptPassword($password)
    {
        return md5(base64_encode($password));
    }

    /**
     * @input: 20/01/2017 ou 01/2017
     * @output: 2017-01-20 ou 2017-01
     */
    public static function convertDate($date)
    {
        return join('-', array_reverse(explode("/", $date)));
    }

    public static function validEmail($email)
    {

        if (strpos($email, "@") === false) {
            return false;
        } else {
            if (strpos($email, ".") === false) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function accentedLetters($str)
    {
        return preg_replace("/[^a-zA-ZÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ\s]/", "", $str);
    }
    public static function letters($str)
    {
        return preg_replace("/[^a-zA-Z\s]/", "", $str);
    }
    public static function alphaNumeric($str)
    {
        return preg_replace("/[^0-9a-zA-Z]/", "", $str);
    }
    public static function numeric($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
    public static function lessSymbols($str)
    {
        return preg_replace("/[^0-9a-zA-ZÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ\s]/", "", $str);
    }
}
