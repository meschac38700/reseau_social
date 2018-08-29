<?php
//demarrage de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title="Home";
require("../vendor/autoload.php");
require(__DIR__ . "/../config/app.php");
include(__DIR__."/../views/index.view.php");