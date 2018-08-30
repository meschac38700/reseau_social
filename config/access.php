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
		session_destroy();
		$_SESSION[]= [];
		redirect('connexion');
	}
	if($page != "profile.php" && $page !="")
	{
		redirect('profile');
	}
}
else
{
	
	if( $page == "profile.php" )
	{
		redirect('connexion');
	}
}
