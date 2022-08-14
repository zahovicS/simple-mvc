<?php
//Libs
require_once dirname(__DIR__) . "/App/Configs/Configs.php";
require_once dirname(__DIR__) . "/App/Libs/Base.php";
require_once dirname(__DIR__) . "/App/Libs/Controller.php";
require_once dirname(__DIR__) . "/App/Libs/Core.php";
//Autload
spl_autoload_register(function ($clase) {
    require_once dirname(__DIR__) . "/App/Libs/" . $clase . ".php";
});
//other
require '../vendor/autoload.php';