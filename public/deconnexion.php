<?php
session_start();
session_destroy();
$_SESSION = [];
require(__DIR__.'/../vendor/autoload.php');
redirect('index');