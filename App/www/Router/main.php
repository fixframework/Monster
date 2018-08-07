<?php
use Fix\Router\Router;
use Fix\Packages\Assets\Assets;

Router::get("/",function(){

    Assets::render("welcome");

});
