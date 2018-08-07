<?php

namespace Fix\Packages\Assets;

use Fix\Support\Support as kernelSupport;

class Support
{



    /**
     * @param null $imgname
     * @return resource
     */
    public static function loadJpg($imgname = null){

        /* Attempt to open */
        $im = @imagecreatefromjpeg($imgname);

        /* See if it failed */
        if(!$im)
        {
            /* Create a black image */
            $im  = imagecreatetruecolor(150, 30);
            $bgc = imagecolorallocate($im, 255, 255, 255);
            $tc  = imagecolorallocate($im, 0, 0, 0);

            imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

            /* Output an error message */
            imagestring($im, 4, 10, 7,"IMAGES NOT FOUND", $tc);
        }

        return $im;
    }

    /**
     * @param null $imgname
     * @return resource
     */
    public static function loadPng($imgname = null){

        /* Attempt to open */
        $im = @imagecreatefrompng($imgname);

        /* See if it failed */
        if(!$im)
        {
            /* Create a blank image */
            $im  = imagecreatetruecolor(150, 30);
            $bgc = imagecolorallocate($im, 255, 255, 255);
            $tc  = imagecolorallocate($im, 0, 0, 0);

            imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

            /* Output an error message */
            imagestring($im, 4, 10, 7, "IMAGES NOT FOUND", $tc);
        }

        return $im;
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    public static function removeSpace($string){

        $string = preg_replace("/\s+/", "", $string);
        $string = trim($string);
        return $string;

    }

    public static function isAssetFilter($setFile = null,$setLoad = false,$composer = false){

        echo $composer ? self::removeSpace(file_get_contents($setFile,true)) : file_get_contents($setFile,true);

    }

    /**
     * @param null $setFile
     * @return null|void
     */
    public static function isAsset($setFile = null,$setLoad = false,$composer = false){

        file_exists($setFile) ? ($setLoad ? ( !$composer ? include($setFile) : self::isAssetFilter($setFile,$setLoad,$composer))  : null) : kernelSupport::__error("FILE NOT FOUND");

    }


}