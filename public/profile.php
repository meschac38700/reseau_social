<?php
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
$title= "Profile";
require(__DIR__."/../vendor/autoload.php");
require(__DIR__."/../config/app.php");
include(__DIR__."/../views/profile.view.php");