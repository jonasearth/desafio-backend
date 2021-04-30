<?php

namespace Fnatic\Services\Auth;

interface IAuthHandler
{
    static function createAdminToken($admin): String;
    static function verifyAdminToken();
}
