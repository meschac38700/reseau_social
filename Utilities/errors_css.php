<?php

if( !function_exists('has_error') )
{
	function has_error( $field, $error_fields )
	{
		$langs = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

		if( array_key_exists($field, $error_fields) )
		{
			return "has-error";
		}
		return "";
	}
}

if(!function_exists('error_span') )
{
	function error_span($field, $error_fields )
	{
		//si un champs est erroné 
		if( array_key_exists($field, $error_fields) )
		{
			//affichage du span avec le message d'erreur
			echo "<span class='text-danger'>$error_fields[$field]</span>";
			session_destroy();
		}
	}
}