<?php
//demarrage de la session
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
$title= "Activate Account";
require(__DIR__."/../vendor/autoload.php");
require(__DIR__."/../config/app.php");
use Database\Mysql\PDO\UserTable;
if( !empty($_GET['user']) && !empty($_GET['token']) )
{
	extract($_GET);
	$user_instance = new  UserTable(null);
	$user = $user_instance->identifier(htmlspecialchars($user) );
	
	if( $user )
	{
		//check if the token is correct
		if( goodToken( $token, $user ) ) 
		{
			//TODO ajout un attribut created_at dans la table user
			$created_at = new DateTime($user->created_at);
			//check if user can alway activate his account, if the deadline is not exceeded yet
			if( activation_enabled( $created_at ) )
			{
				$success = $user_instance->active($user->pseudo);
			
				//Stockage des données de l'utilisateur en session
				$_SESSION['user']['pseudo'] = $user->pseudo;
				$_SESSION['user']['email'] = $user->email;
				$_SESSION['user']['last_name'] = $user->last_name;
				$_SESSION['user']['first_name'] = $user->first_name;
				// redirection vers la page de profile de l'utilisateur 
                redirect('profile');
			}
			//Delete the user account due to the account activation deadline that was exceeded
			$user_instance->delete($user->pseudo);			
		}
		
	}
	$_SESSION['deadline'] = "La date limite d'activation du compte a été depassée! Veuillez vous réinscrire <a href='". $config['web_url'] ."/inscription.php'>ici</a>";
	$_SESSION['erreur_message'] = "Il y a eu un problème lors de la tentative d'activation du compte !";
	redirect('erreur');
	
}