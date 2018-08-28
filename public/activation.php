<?php
//demarrage de la session
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
require("../vendor/autoload.php");
use Database\Mysql\PDO\UserTable;
if( !empty($_GET['user']) && !empty($_GET['token']) )
{
	$user_instance = new  UserTable(null);
	$user = $user_instance->identifier(htmlspecialchars($_GET['user']) );
	if( $user )
	{
		// Activer le compte utitlisateur
		$success = $user_instance->active( $user->pseudo );
		
		//Stockage des données de l'utilisateur en session
		$_SESSION['user']['pseudo'] 	= $user->pseudo;
		$_SESSION['user']['email'] 		= $user->email;
		$_SESSION['user']['last_name'] 	= $user->last_name;
		$_SESSION['user']['first_name'] = $user->first_name;
		// redirection vers la page de profile de l'utilisateur 
		header('Location: profile.php');
		exit();
	}
	else
	{
		$_SESSION['erreur_message'] = "Il y a eu un problème lors de la tentive d'activation du compte !";
		header('Location: erreur.php');
		exit();
	}
}