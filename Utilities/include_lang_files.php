<?php 
$langs = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

include(__DIR__.'/../config/app.php');
if( !empty( $config['lang'] ) )
{
	include(__DIR__."/../views/lang/{$config['lang']}/form.php");
}
else
{
	include(__DIR__."/../views/lang/$langs[0]/form.php");
}
