<?php

namespace Fix\Support;



use Fix\Kernel\Url;
use Fix\Settings\Kernel as Settings;


class Translate
{

    /**
     * @param null $__setFile
     * @return bool
     */
    protected static function __isLanguageFile($__setFile = null){

        return file_exists
        (
            Settings::APPLICATIONS_MASTER_FOLDER.
            Settings::SLASH.
            Url::getSettings()["folder"].
            Settings::SLASH.
            Settings::ASSETS_TRANSLATE_FOLDER.
            Settings::SLASH.
            $__setFile.
            Settings::TRANSLATE_EXTENSION
        );

    }

    /**
     * @param null $__setFile
     * @return bool|string
     */
    protected static function __getLanguage($__setFile = null){

        return file_get_contents
        (
            Settings::APPLICATIONS_MASTER_FOLDER.
            Settings::SLASH.
            Url::getSettings()["folder"].
            Settings::SLASH.
            Settings::ASSETS_TRANSLATE_FOLDER.
            Settings::SLASH.
            $__setFile.
            Settings::TRANSLATE_EXTENSION
        );

    }

    /**
     * @param null $__setFile
     * @return mixed
     */
    protected static function __setDecodeLanguage($__setFile = null){

        return  json_decode(self::__getLanguage($__setFile));

    }

    /**
     * @param null $__setKey
     * @param null $__setLanguage
     * @return bool
     */
    protected static function __getLanguageKey($__setKey = null, $__setLanguage = null){

        return isset(self::__setDecodeLanguage($__setLanguage)->{$__setKey});

    }


    /**
     * @param $__setLanguage
     * @param $__parameter
     * @return mixed
     */
    public static function __callStatic($__setLanguage = null, $__parameter = null){

        if($__setLanguage and $__parameter[0]):

            if(self::__isLanguageFile($__setLanguage)):

                if(self::__getLanguageKey($__parameter[0],$__setLanguage)):

                    return self::__setDecodeLanguage($__setLanguage)->{$__parameter[0]};

                else:
                    Support::__error("NOT FOUND KEY : {$__parameter[0]}");
                endif;

            else:
                Support::__error("NOT FOUND LANGUAGE FILE : {$__setLanguage}");
            endif;

        else:
            Support::__error("ENTER PARAMETER VALUES");
        endif;
    }

    /**
     * @param $__setLanguage
     * @param $__parameter
     * @return mixed
     */
    public  function __call($__setLanguage = null, $__parameter = null){

        if($__setLanguage and $__parameter[0]):

            if(self::__isLanguageFile($__setLanguage)):

                if(self::__getLanguageKey($__parameter[0],$__setLanguage)):

                    return self::__setDecodeLanguage($__setLanguage)->{$__parameter[0]};

                else:
                    Support::__error("NOT FOUND KEY : {$__parameter[0]}");
                endif;

            else:
                Support::__error("NOT FOUND LANGUAGE FILE : {$__setLanguage}");
            endif;

        else:
            Support::__error("ENTER PARAMETER VALUES");
        endif;
    }


}
