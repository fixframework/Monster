<?php

namespace Fix\Support;


class Json
{

    private static  $__getData =  array();

    /**
     * @param Mixed $__name
     * @param Mixed $__parameter
     * @return object
     */
    public static function __callStatic($__name, $__parameter){

        if(is_array($__parameter)):
            if(count($__parameter) > 1):
                if(isset(self::$__getData[$__name])):
                    return (object) self::$__getData[$__name][] = $__parameter;
                else:
                    return (object) self::$__getData[$__name] = $__parameter;
                endif;
            else:
                if(isset(self::$__getData[$__name])):
                    return (object) self::$__getData[$__name][] = $__parameter[0];
                else:
                    return (object) self::$__getData[$__name] = $__parameter[0];
                endif;
            endif;
        elseif (is_scalar($__parameter)):
            return (object) self::$__getData[$__name] = $__parameter;
        endif;

    }
    /**
     * @param Mixed $__name
     * @param Mixed $__parameter
     * @return object
     */
    public function __call($__name, $__parameter){

        if(is_array($__parameter)):
            if(count($__parameter) > 1):
                if(isset(self::$__getData[$__name])):
                    return (object) self::$__getData[$__name][] = $__parameter;
                else:
                    return (object) self::$__getData[$__name] = $__parameter;
                endif;
            else:
                if(isset(self::$__getData[$__name])):
                    return (object) self::$__getData[$__name][] = $__parameter[0];
                else:
                    return (object) self::$__getData[$__name] = $__parameter[0];
                endif;
            endif;
        elseif (is_scalar($__parameter)):
            return (object) self::$__getData[$__name] = $__parameter;
        endif;

    }


    /**
     * @param Mixed $__name
     * @return object
     */
    public function __get($__name = null){

      return self::$__getData[$__name];

    }

    /**
     * @return Json
     */
    public static function toJson(){

        return json_encode(self::$__getData);

    }

}
