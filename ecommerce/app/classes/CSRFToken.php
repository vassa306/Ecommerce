<?php
namespace app\classes;

class CSRFToken
{

    public static function _token()
    {
        if (!Session::has('token')) {
            $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
            Session::add('token', $randomToken);
        }
        return Session::get('token');
    }

    public static function verifyCSRFToken($requestToken, $regenerate = false)
    {
        if (Session::has('token') && Session::get('token') === $requestToken) {
            if ($regenerate) {
                Session::removeSession('token');
                ;
            }

            return true;
        }
        return false;
    }
}

