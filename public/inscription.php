<?php

require("../vendor/autoload.php");
include('../config/app.php');
include('../views/lang/'.$config['lang'].'/form.php');
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
			$error_fields['last_name'] = getMessgae($lang['form']['field']['last_name'],$lang['form']['message']['min'], 3 );
		}
		
		//verifier si le champ first_name contient au moins 3 caractères
		if( mb_strlen($first_name) < 3 )
		{
			$error_fields['first_name'] = getMessgae($lang['form']['field']['first_name'],$lang['form']['message']['min'], 3 );
		}
		
		// verifier si le champs email est bel et bien un email
		if ( filter_var($email, FILTER_VALIDATE_EMAIL) )
		{
			// verifier si l'email n'est pas deja utilisé !
			$check_email = $user->get($email);
			//Si c'est le cas, le mail a deja été utilisé

			if($check_email)
			{
				$error_fields['email'] = $lang['form']['message']['mail_already_used'];
			}
		}
		else
		{
			$error_fields['email'] = $lang['form']['message']['email'];
		}
		
		// verifier si le champs mot de passe contient au moins 6 caractères 
		if( mb_strlen($password) >= 6 )
		{
			// verifier si le champs confirmer mot de passe correspond au mot de passe rentré pécédemment !
			if( $password !== $password_confirm)
			{
				$error_fields['password_confirm'] = getMessgae($lang['form']['field']['password_confirm'],$lang['form']['message']['bad_password_confirm']);
			}
		}
		else
		{
			$error_fields['password'] = getMessgae($lang['form']['field']['password'],$lang['form']['message']['min'], 6 );
		}
		
		//Si tous s'est bien passé, le formulaire a été bien remplis ...
		if( empty($error_fields) )
		{
			$success = $user->insert();
			if( $success['status'] )
			{
				//Demarrage de la start
				session_start();
				//Stockage des données de l'utilisateur en session
				$_SESSION['pseudo'] 	= $pseudo;
				$_SESSION['email'] 		= $email;
				$_SESSION['last_name'] 	= $last_name;
				$_SESSION['first_name'] = $first_name;
				// redirection vers la page de profile de l'utilisateur
				header("Location: profile.php");
			}
			else
			{
				//En cas d'erreur lors de la création du compte redirection vers la page erreur.php
				session_start();
				$_SESSION['erreur_message'] = $success['message'];
				header("Location: erreur.php");
			}
		}
	}
}



include("../views/inscription.view.php");