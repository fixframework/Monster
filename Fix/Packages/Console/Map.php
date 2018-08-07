<?php

namespace Fix\Packages\Console;

use Fix\Settings\Kernel;

class Map
{

    static $getParameter;

    /**
     * Request constructor.
     * @param array $getParameter
     */
    public function __construct( array $getParameter = [] ){

        // Return $args
        self::$getParameter = $getParameter;

    }

    public static function startMap(){

        print  "-------------------\t\t\t\t\t-----------------------";
        print  "\n|     Command     |\t\t\t\t\t|     Description     |\n";
        print  "-------------------\t\t\t\t\t-----------------------\n";

    }

    public static function addMap($Parameter = null, $Details = null,$key = 1){

        print $Parameter.str_repeat(" ",strlen($Parameter) + $key)."\t".$Details."\n";

    }

    private static function getCommands(){

        $classes = scandir(str_replace("\\","/",__DIR__)."/Command");
        unset($classes[0]);
        unset($classes[1]);
        return array_values($classes);

    }


    public static function loadCommands(){

        if(count(self::getCommands()) >= 1):
            foreach (self::getCommands() as $class):
                $getClass = (__NAMESPACE__."\\Command\\".str_replace(".php","",$class));
                new $getClass();
            endforeach;
        endif;

    }

    public static function getVersion(){

        print "Name \t\t:\t".Kernel::FRAMEWORK_NAME.PHP_EOL;
        print "Version \t:\t".Kernel::FRAMEWORK_VERSION;

    }

    public static function getCreate(){

    }

    public static function getDelete(){

    }

    public static function getHelp(){

        // Command Header
        self::startMap();

        // Load Command Classes
        self::loadCommands();

        Map::addMap("--version","Framework version",30);
        Map::addMap("--create","Create file or folder",35);
        Map::addMap("--delete","Delete file or folder",35);
        Map::addMap("--help","Help point",40);
        Map::addMap("-m command::function <par>","Type the command line you want",0);

    }

}