<?php


namespace Fix\Settings;

use Fix\Support\Support;

class App
{

    const APP =
        [

            "localhost" => [
                "folder"                => "www",
                "router"                => "main",
                "assets"                => false,
                "https"                 => false,
                "maintenance"           => false,
                "maintenanceRouter"     =>
                    [
                        "/" =>
                            [
                                "0.0.0.0",
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

            // ... e.g parameters of your application

        ];


}

