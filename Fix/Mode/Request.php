<?php

namespace Fix\Mode;


class Request
{

    public static function __notFoundMode($Request = null){

        return $Request;

    }

    public static function __fixCreatorMode($Request = null){

        return $Request;

    }

    public static function __maintenanceMode($Request = null){

        return $Request;

    }

    public static function __blocMode($Request = null){

        return $Request;

    }

}