<?php 


$uri = explode('/',$_SERVER["REQUEST_URI"] );
$page = $uri[1];

if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
if( !empty($_SESSION['user']['pseudo']) )
{
	$user = new \Database\Mysql\PDO\UserTable(null);
	$user_exist = $user->get($_SESSION['user']['pseudo']);
	if( !$user_exist )
	{
		header('Location: connexion.php');
		exit();
	}
	if($page != "profile.php")
	{
		header('Location: profile.php');
		exit();
	}
}
else
{
	
	if( $page == "profile.php" )
	{
		header('Location: connexion.php');
		exit();
	}
}
