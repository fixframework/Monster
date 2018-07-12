<?php


namespace Fix\Settings;

use App\www\Controllers\__class;
use Fix\Support\Header;
use Fix\Support\Support;

class App
{

    const APP =
        [

            "127.0.0.1" => [
                "folder"                => "www",
                "router"                => "Master",
                "cdn"                   => false,
                "assets"                => false,
                "encodeCompression"     => false,
                "https"                 => false,
                "maintenance"           => false,
                "maintenanceRouter"     =>
                    [
                        "/" =>
                            [
                                "127.0.0.1",
                                Support::GET,
                                [
                                    "username" => "developer",
                                    "password" => "123",

                                ]

                            ]
                    ],
                "autoLoadClass"         => [],
                "database"              =>
                    [
                        "driver"        => "mysql",
                        "host"          => "localhost",
                        "username"      => "root",
                        "password"      => "",
                        "table"         => "",
                        "charset"       => "utf8",
                        "prefix"        => null
                    ]
            ]

            // ... e.g Recode your applications

        ];


}

