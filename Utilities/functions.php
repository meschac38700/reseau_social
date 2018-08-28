<?php
if( !function_exists('getMessage') )
{
	/**
	 * replace :attribute in the msg to the fieldName
	 * @param  string $fieldName field name to introduce in the msg
	 * @param  string $msg       origin msg
	 * @return string            new msg 
	 */
	function getMessage( $fieldName, $msg, $min=3)
	{
		if( $min )
		{
			$pattern = "%:m[a-z]{2}%i";
			$msg = preg_replace($pattern, $min, $msg);
		}
		$pattern = "%:[a-z]{4,}%i";
		$new_msg = preg_replace($pattern, $fieldName, $msg);

		return $new_msg;
	}
}

if( !function_exists('sendEmailUTF_8'))
{
	function sendEmailUTF_8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
	{

      	$from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
      	$subject = "=?UTF-8?B?".base64_encode($subject)."?=";
      	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
     	$headers = 'MIME-Version: 1.0'."\r\n";
     	$headers .= 'Content-type: text/html; charset=iso-8859-1';

     	return mail($to, $subject, $message, $headers);

	}
}

if( !function_exists('not_empty') )
{
	function not_empty( $fields )
	{
		include_once(__DIR__.'/include_lang_files.php');

		$error_fields = [];
		foreach($fields as $key => $value )
		{
			if( empty($value) || trim($value) === "")
			{
				$error_fields[$key] = getMessage($lang['form']['field'][$key],$lang['form']['message']['required'] );
			}
		}
		return $error_fields;
	}
}

if( !function_exists('active') )
{
	function active( $current_page )
	{
		$uri = explode('/',$_SERVER["REQUEST_URI"] );
		$page = $uri[1];
		if( $page == $current_page )
		{
			return 'active';
		}
	}
}

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
			
		}
	}
}