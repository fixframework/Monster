<?php

namespace Fix\Kernel;


use Fix\Kernel\Url;
use Fix\Kernel\Filter;
use Fix\Middleware\Middleware;
use Fix\Support\Support;

class Kernel
{

    /**
     * Kernel constructor.
     */
    public function __construct($Request = null){

        // System Start Middleware
        Middleware::__start($Request);

        // System Starting
        new Filter(Support::class );

        // System Finished Middleware
        Middleware::__finish($Request);

    }

    public static function fix($Request = null){

        return self::class;

    }

}