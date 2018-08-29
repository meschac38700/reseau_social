<?php
//demarrage de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require("../vendor/autoload.php");
include(__DIR__ . "/../views/erreur.view.php");