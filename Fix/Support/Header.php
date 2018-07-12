<?php


namespace Fix\Support;


class Header
{


    /**
     * @param string $AUTH_USER
     * @param string $AUTH_PASS
     */
    public static function httpAut($AUTH_USER = "admin", $AUTH_PASS = "admin"){

        self::noCache();

        if
        (
            (
                empty($_SERVER["PHP_AUTH_USER"]) && empty($_SERVER["PHP_AUTH_PW"])) ||
                $_SERVER["PHP_AUTH_USER"] != $AUTH_USER || $_SERVER["PHP_AUTH_PW"]   != $AUTH_PASS
        ) :
            header('HTTP/1.1 401 Authorization Required');
            header('WWW-Authenticate: Basic realm="Access denied"');
            die();
        endif;

    }

    public static function noCache(){

        header("Expires: 0");
        header("Pragma: no-cache");
        header("Cache-Control: no-cache,no-store,max-age=0,s-maxage=0,must-revalidate");

    }

    public static function notFound(){

        header("HTTP/1.1 404 Not Found");

    }

    /**
     * @param null $target
     */
    public static function redirect($target = null){

        header("Location: ".$target);

    }

}