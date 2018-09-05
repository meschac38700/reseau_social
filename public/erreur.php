<?php
//demarrage de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$title= "Error";
require("../vendor/autoload.php");
require(__DIR__ . "/../config/app.php");
include(__DIR__ . "/../views/erreur.view.php");
unset($_SESSION['erreur_message']);