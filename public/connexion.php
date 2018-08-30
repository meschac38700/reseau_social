<?php 
//demarrage de la session
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
$title ="Connection";
require_once(__DIR__."/../vendor/autoload.php");
if( !isset($config) ) include(__DIR__.'/../config/app.php');
use Database\Mysql\PDO\UserTable;
include('../views/lang/'.$config['lang'].'/form.php');

$error_fields =[];

if( isset($_POST['connexion']) )
{
	$error_fields = not_empty($_POST);
	if( empty($error_fields) )
	{
		//Instanciation de la class UserTable
		$user = new UserTable($_POST);
		// check dans la DB si l'identifiant existe et surtout le mdp correspond au mdp qui a été donné ! TODO
		$user = $user->identifier(null, true);
		
		extract($_POST);
		if( !$user )
		{
			$_SESSION['erreur_message'] = $lang['form']['message']['fail_identification'];
            redirect('connexion');
		}
		
		if( $user->active == '1' )
		{
			//Stockage des données de l'utilisateur en session
			$_SESSION['user']['pseudo'] 	= $user->pseudo;
			$_SESSION['user']['email'] 		= $user->email;
			$_SESSION['user']['last_name'] 	= $user->last_name;
			$_SESSION['user']['first_name'] = $user->first_name;
			// redirection vers la page de profile de l'utilisateur 
            redirect('profile');
		}
		else
		{
			//Si le compte n'est pas encore activé rediriger vers la vue message activation compte
            redirect('rappelle-activation', ["user"=>$user->pseudo, "email"=>$user->email]);
		}
		
	}
}

include(__DIR__.'/../views/connexion.view.php');