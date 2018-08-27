<?php
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}

require(__DIR__."/../vendor/autoload.php");

include(__DIR__."/../views/profile.view.php");