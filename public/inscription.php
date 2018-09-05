<?php
//demarrage de la session
if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
$title= "Sign up";
require("../vendor/autoload.php");
include("../config/app.php");
include("../views/lang/".$config['lang']."/form.php");
use Database\Mysql\PDO\UserTable;

$error_fields =[];

if( isset($_POST['inscription']) )
{
	extract($_POST);
	$error_fields = not_empty($_POST);

	if( empty($error_fields) )
	{
		$user = new UserTable($_POST);
		
		//verifier si le champ last_name contient au moins 3 caractères
		if(mb_strlen($last_name) < 3 ) 
		{
			$error_fields['last_name'] = getMessage($lang['form']['field']['last_name'],$lang['form']['message']['min'], 3 );
		}
		
		//verifier si le champ first_name contient au moins 3 caractères
		if( mb_strlen($first_name) < 3 )
		{
			$error_fields['first_name'] = getMessage($lang['form']['field']['first_name'],$lang['form']['message']['min'], 3 );
		}
		
		//verifier si le pseudo n'est pas deja utilisé
		if( $user->identifier($user->getPseudo()))
		{
			$error_fields['pseudo'] = getMessage($lang['form']['field']['pseudo'], $lang['form']['message']['already_used']);
		}


		
		// verifier si le champs email est bel et bien un email
		if ( filter_var($email, FILTER_VALIDATE_EMAIL) )
		{
			// verifier si l'email n'est pas deja utilisé !
			$check_email = $user->get($email);
			//Si c'est le cas, le mail a deja été utilisé
			if($check_email)
			{
				$error_fields['email'] = getMessage($lang['form']['field']['email'], $lang['form']['message']['already_used']);
			}
		}
		else
		{
			$error_fields['email'] = $lang['form']['message']['email'];
		}
		
		// verifier si le champs mot de passe contient au moins 6 caractères 
		if( mb_strlen($password) >= 6 )
		{
		    //verifier si le mot de passe existe deja dans la bdd
            if( $user->checkPassword($password))
            {
                $error_fields['password'] = getMessage($lang['form']['field']['password'], $lang['form']['message']['already_used']);
            }
            else
            {
                // verifier si le champs confirmer mot de passe correspond au mot de passe rentré pécédemment !
                if( $password !== $password_confirm)
                {
                    $error_fields['password_confirm'] = getMessage($lang['form']['field']['password_confirm'],$lang['form']['message']['bad_password_confirm']);
                }
            }

        }
		else
		{
			$error_fields['password'] = getMessage($lang['form']['field']['password'],$lang['form']['message']['min'], 6 );
		}
		
		//Si tous s'est bien passé, le formulaire a été bien remplis ...
		if( empty($error_fields) )
		{
			$token = '_'.sha1($email.$password.$pseudo);
			$user->setToken($token);		
			$success 	= $user->insert();
			if( $success['status'] )
			{
				//Envoie d'un mail d'activation 

				$to 		= $email;
				$from_user	= $config['app_name'];
				$from_email = $config['email'];
				$subject 	= $config['app_name']. " - Activation de compte";
				$token 		= sha1($pseudo.$email.sha1($password));
				$activation_url = $config['web_url'] . '/activation.php?user='.$pseudo.'&amp;token='.$token;
				
				//memoire temporaire de la vue email activation
				ob_start();
				require(__DIR__.'/../views/emails/activation_account.view.php');
				$content = ob_get_clean();
				
				//sendEmailUTF_8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
				$emailSend = sendEmailUTF_8($to, $from_user, $from_email, $subject, $content);

				//redirection vers la page rappelle activation compte
                redirect('rappelle-activation', ["user"=>$pseudo, "email"=>$email]);
			}
			else
			{
				//En cas d'erreur lors de la création du compte redirection vers la page erreur.php			
				$_SESSION['erreur_message'] = $success['message'];
                redirect('erreur');
			}
		}
		
	}
}

include("../views/inscription.view.php");