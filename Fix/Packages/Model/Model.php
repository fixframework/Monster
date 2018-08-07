<?php

namespace Fix\Packages\Model;


use Fix\Support\Support;
use Fix\Kernel\Kernel;
use Fix\Kernel\Url;
use Fix\Settings\Kernel as Settings;

class Model
{

    /**
     * @param null $__setFile
     * @param null $__setData
     * @return bool
     */
    public static function render($__setFile = null, $__setData = null){


        if($__setFile):

            if(
            file_exists
            (
                Settings::APPLICATIONS_MASTER_FOLDER.
                Settings::SLASH.
                Url::getSettings()["folder"].
                Settings::SLASH.
                Settings::MODELS_FOLDER.
                Settings::SLASH.
                $__setFile.
                Settings::CORE_EXTENSION
            )
            ):

                include
                (
                    Settings::APPLICATIONS_MASTER_FOLDER.
                    Settings::SLASH.
                    Url::getSettings()["folder"].
                    Settings::SLASH.
                    Settings::MODELS_FOLDER.
                    Settings::SLASH.
                    $__setFile.
                    Settings::CORE_EXTENSION
                );

                if(class_exists($__setFile)):

                    return new $__setFile($__setData);

                else:

                    Support::__error("NOT FOUND MODEL");

                endif;

            else:
                Support::__error("NOT FOUND MODEL FILE");
            endif;

        else:
            Support::__error("ENTER MODEL NAME");
        endif;

    }

}