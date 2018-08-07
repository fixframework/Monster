<?php

namespace Fix\Packages\Assets;

use Fix\Support\Header;
use Fix\Support\Support;
use Fix\Settings\Kernel;
use Fix\Kernel\Url;
use Fix\Packages\Assets\Support as supportAssets;

class Assets
{

    

    const DEFAULT_ASSETS_PARAMETER =
        [
            "css" =>
                [
                    "load"     => true,
                    "composer" => false
                ],
            "js" =>
                [
                    "load"     => true,
                    "composer" => false
                ],
            "font" =>
                [
                    "load"     => true,
                    "composer" => false
                ],
            "external" =>
                [
                    "load"     => true,
                    "composer" => false
                ],
            "jpg" =>
                [
                    "quality" => 100
                ],
            "png" =>
                [
                    "quality" => 100
                ]
        ];

    /**
     * @param null $__setFile
     * @param null $__setData
     * @return bool
     */
    public static function render($__setFile = null, $__setData = null){

        if($__setFile):

                is_array($__setData) ? extract($__setData) : null;

                supportAssets::isAsset
                (
                    Kernel::APPLICATIONS_MASTER_FOLDER.
                    Kernel::SLASH.
                    Url::getSettings()["folder"].
                    Kernel::SLASH.
                    Kernel::VIEWS_FOLDER.
                    Kernel::SLASH.
                    Kernel::ASSETS_PAGES_FOLDER.
                    Kernel::SLASH.
                    $__setFile.
                    Kernel::CORE_EXTENSION,
                    true
                );

                return true;

        else:
            Support::__error("ENTER FILE NAME");
        endif;

    }

    public static function getCss($setFile = null,$autoload = false,$composer  = false){

        Header::content("text/css");

        supportAssets::isAsset
        (
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_CSS_FOLDER.
            Kernel::SLASH.
            $setFile.
            ".css",
            $autoload,
            $composer
        );

    }


    public static function getExternal($setFile = null,$autoload = false, $composer  = false){

        supportAssets::isAsset
        (
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_EXTERNAL_FOLDER.
            Kernel::SLASH.
            $setFile,
            $autoload,
            $composer
        );

    }

    public static function getFont($setFile = null,$autoload = false){

        Header::content("font/opentype");

        supportAssets::isAsset
        (
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_FONT_FOLDER.
            Kernel::SLASH.
            $setFile,
            $autoload
        );

    }

    public static function getJavascript($setFile = null,$autoload = false,$composer  = false){

        Header::content("application/javascript");

        supportAssets::isAsset
        (
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_JS_FOLDER.
            Kernel::SLASH.
            $setFile.
            ".js",
            $autoload,
            $composer
        );

    }

    /**
     * @param null $setFile
     */
    public static function getImagesJpg($setFile = null, $setQuality = 100){

        header::content("image/jpeg");

        $img = supportAssets::loadJpg(
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_IMAGE_FOLDER.
            Kernel::SLASH.
            $setFile.
            ".jpg"
        );

        imagejpeg($img,null,$setQuality);
        imagedestroy($img);

    }

    /**
     * @param null $setFile
     */
    public static function getImagesPng($setFile = null){


        header::content("image/jpg");

        $img = supportAssets::loadPng(
            Kernel::APPLICATIONS_MASTER_FOLDER.
            Kernel::SLASH.
            Url::getSettings()["folder"].
            Kernel::SLASH.
            Kernel::VIEWS_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_MASTER_FOLDER.
            Kernel::SLASH.
            Kernel::ASSETS_IMAGE_FOLDER.
            Kernel::SLASH.
            $setFile.
            ".png"
        );

        imagepng($img);
        imagedestroy($img);

    }


    /**
     * @param null $type
     * @param null $file
     */
    public static function autoAssetsLoader($type = null, $file = null, $settings = self::DEFAULT_ASSETS_PARAMETER){

        if($type === "css"):
            Assets::getCss(
                $file,
                $settings["css"]["load"] ?? true,
                $settings["css"]["composer"] ?? false
            );
        elseif($type === "js"):
            Assets::getJavascript(
                $file,
                $settings["js"]["load"] ?? true,
                $settings["js"]["composer"] ?? false
            );
        elseif($type === "jpg"):
            Assets::getImagesJpg(
                $file,
                $settings["jpg"]["quality"] ?? 100
            );
        elseif($type === "png"):
            Assets::getImagesPng(
                $file
            );
        elseif($type === "external"):
            Assets::getExternal(
                $file,
                $settings["external"]["load"] ?? false,
                $settings["external"]["composer"] ?? false
            );
        elseif($type === "font"):
            Assets::getFont(
                $file,
                $settings["external"]["load"] ?? true
            );
        else:
            Support::__error("NOT FOUND");
        endif;

    }

}