<?php 
session_start();
use Database\Mysql\PDO\UserTable;
require("../vendor/autoload.php");
include('../config/app.php');
include('../views/lang/'.$config['lang'].'/form.php');

$error_fields =[];

if( isset($_POST['connexion']) )
{
	$error_fields = not_empty($_POST);
	if( empty($error_fields) )
	{
		//TODO 
		//Instanciation de la class UserTable
		$user = new UserTable($_POST);
		// check dans la DB si l'identifiant existe et surtout le mdp correspond au mdp qui a été donné ! TODO
		$user = $user->identifier();
		if( !$user )
		{
			$_SESSION['erreur_message'] = $lang['form']['message']['fail_identification'];
			header('Location: connexion.php');
		}
		
		//Stockage des données de l'utilisateur en session
		$_SESSION['pseudo'] 	= $user->pseudo;
		$_SESSION['email'] 		= $user->email;
		$_SESSION['last_name'] 	= $user->last_name;
		$_SESSION['first_name'] = $user->first_name;
		// redirection vers la page de profile de l'utilisateur
		header('Location: profile.php');
	}
}

include(__DIR__.'/../views/connexion.view.php');