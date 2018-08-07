<?php

namespace Fix\Packages\Console;

class Request
{

    static $getParameter;

    /**
     * Request constructor.
     * @param array $getParameter
     */
    public function __construct( array $getParameter = [] ){

        self::$getParameter = $getParameter;

        // Command Serialize
        self::serializeCommand();

    }

    public static function serializeCommand(){

            if(self::$getParameter[1] === "--version"):
                unset(self::$getParameter[0]);
                unset(self::$getParameter[1]);
                Map::getVersion(array_values(self::$getParameter));
            elseif(self::$getParameter[1] === "--create"):
                unset(self::$getParameter[0]);
                unset(self::$getParameter[1]);
                Map::getCreate(array_values(self::$getParameter));
            elseif(self::$getParameter[1] === "--delete"):
                unset(self::$getParameter[0]);
                unset(self::$getParameter[1]);
                Map::getDelete(array_values(self::$getParameter));
            elseif(self::$getParameter[1] === "--help"):
                unset(self::$getParameter[0]);
                unset(self::$getParameter[1]);
                Map::getHelp(array_values(self::$getParameter));
                else:
                Map::getHelp();
            endif;


    }


}