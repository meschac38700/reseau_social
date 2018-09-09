<?php 
$langs = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
require_once(__DIR__.'/../config/app.php');
if( !empty( $config['lang'] ) )
{
	require(__DIR__."/../views/lang/{$config['lang']}/form.php");
}
else 
{
	require(__DIR__."/../views/lang/$langs[0]/form.php");
}

