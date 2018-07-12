<?php

namespace Fix\Support;

use Fix\Kernel\Url;
use Fix\Router\Router;
use Fix\Settings\App;

class Support
{


    const POST                  = "POST";
    const GET                   = "GET";
    const PUT                   = "PUT";
    const DELETE                = "DELETE";
    const HEAD                  = "HEAD";
    const OPTIONS               = "OPTIONS";
    const PATCH                 = "PATCH";

    /**
     * @param null $Request
     */
    public static function __error($Request = null){

        return die($Request);

    }

    /**
     * @param null $Request
     */
    public static function __notFound($Request = null){

        echo "Not Found Application";

    }

    /**
     * @param null $Request
     */
    public static function __maintenance($Request = null){

        echo "Maintenance Mode";

    }

    /**
     * @param null $Request
     */
    protected static function __errorDebug($Request = null){

        register_shutdown_function( function (){
            error_get_last() ?  die(json_encode(error_get_last())) : null;
        });

    }

    /**
     * @param null $Request
     */
    public static function __maintenanceMode($Request = null){

        if(Url::getSettings()["maintenance"]):

            foreach (Url::getSettings()["maintenanceRouter"] as $_key => $__mainList):

                if(Router::isMatch(Router::withReplaceUrl($_key,(isset($__mainList[1]) ? $__mainList[1] : "GET"))[0],(isset($__mainList[1]) ? $__mainList[1] : "GET"))):

                    if($_SERVER["REMOTE_ADDR"] !== $__mainList[0]):

                        if(isset($__mainList[1])):

                            if(is_array($__mainList[2]) and isset($__mainList[2]["username"]) and isset($__mainList[2]["password"])):

                                Header::httpAut
                                (
                                    $__mainList[2]["username"],
                                    $__mainList[2]["password"]
                                );

                            endif;

                        else:
                                die
                                (
                                    call_user_func_array(
                                        [
                                            Support::class,
                                            "__maintenance"
                                        ],
                                        []
                                    )
                                );
                        endif;

                    endif;


                endif;


            endforeach;

        endif;

    }

    /**
     * @param null $Request
     */
    protected static function __autoLoader($Request = null){

        foreach ( Url::getSettings()["autoLoadClass"] as $__Config ): new $__Config($Request); endforeach;

    }

    /**
     * @param null $Request
     */
    public static function __getLoad($Request = null){

        // Error Debug Screen
        self::__errorDebug($Request);

        // Maintenance Mode
        self::__maintenanceMode($Request);

        // Auto Class Loader
        self::__autoLoader($Request);


    }

}