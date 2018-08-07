<?php


namespace Fix\Settings;

use Fix\Support\Support;

class Kernel {

    // SYSTEM MODEL
    const SYSTEM_MODE                       = "web";

    // EXTERNAL
    const SLASH                             = "/";

    // APP
    const APPLICATIONS_MASTER_FOLDER        = "App";
    const CONTROLLER_FOLDER                 = "Controller";
    const HOOKS_FOLDER                      = "Hook";
    const MODELS_FOLDER                     = "Model";
    const ROUTERS_FOLDER                    = "Router";
    const VIEWS_FOLDER                      = "Views";
    const CORE_EXTENSION                    = ".php";
    const TRANSLATE_EXTENSION               = ".json";
    const MULTIPLE_STATUS                   = true;
    const DEFAULT_FOLDER                    = "www";


    // ASSETS
    const ASSETS_MASTER_FOLDER              = "Assets";
    const ASSETS_JS_FOLDER                  = "Javascript";
    const ASSETS_HTML_FOLDER                = "Html";
    const ASSETS_CSS_FOLDER                 = "Css";
    const ASSETS_IMAGE_FOLDER               = "Image";
    const ASSETS_FONT_FOLDER                = "Font";
    const ASSETS_PAGES_FOLDER               = "Pages";
    const ASSETS_EXTERNAL_FOLDER            = "External";
    const ASSETS_TRANSLATE_FOLDER           = "Translate";


    // SYSTEM
    const SYSTEM_MASTER_FOLDER              = "Fix";
    const SYSTEM_ROUTER_FOLDER              = "Routers";
    const SYSTEM_AUTOLOADER_FOLDER          = "AutoLoader";
    const SYSTEM_SETTINGS_FOLDER            = "Settings";
    const SYSTEM_VENDOR_FOLDER              = "External";

    // CREATOR
    const CREATOR_STATUS                    = false;
    const CREATOR_IP                        = "0.0.0.0";

    // CREATOR
    const FRAMEWORK_VERSION                    = "1.0.0";
    const FRAMEWORK_NAME                       = "MONSTER";



}