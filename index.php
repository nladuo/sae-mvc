<?php

define("BASE_DIR", __DIR__);

include BASE_DIR . "/vendor/autoload.php";
include BASE_DIR . "/core/Router.php";

(new \Core\Router())->start();
