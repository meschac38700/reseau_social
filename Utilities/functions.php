<?php

use Database\Mysql\PDO\UserTable;

if( ! function_exists('redirect'))
{
    /**
     * redirect to another page
     * @param $page
     * @param $p_params
     */
    function redirect($page, $p_params="")
    {
        $params = "";
        if($p_params)
        {
            $params = "?";
            foreach ($p_params as $key => $value)
            {
                $params .= $key."=".$value ."&";
            }
            // replace the last & to empty stryng ""
            $params = preg_replace("%\&$%i", "", $params);
        }
        header('Location: '.$page.'.php'.$params);
        exit();
    }
}

if( !function_exists('activation_enabled') )
{
	/**
	 * check if user since the creation of his account can always activate his account
	 * @param  DateTime $created_at user's account date of creation
	 * @return boolean   enabled_to_activate
	 */
	function activation_enabled( $created_at )
	{
		$current_date = new DateTime();
		$deadLine = $created_at;
		$deadLine = $deadLine->modify("+1 day");
		//check year
		if( intval($deadLine->format('Y') ) == intval( $current_date->format('Y') ) )
		{
			//check month
			if (intval($deadLine->format('m')) == intval($current_date->format('m'))) 
			{
				//check day
				if (intval($deadLine->format('d')) > intval($current_date->format('d'))) 
				{
					return true;
				} 
				elseif (intval($deadLine->format('d')) == intval($current_date->format('d')))
				{
					//check hour
					if (intval($deadLine->format('H')) > intval($current_date->format('H'))) 
					{
						return true;
					}
					elseif( intval($deadLine->format('H')) == intval($current_date->format('H')) )
					{
						//check minute
						if (intval($deadLine->format('i')) > intval($current_date->format('i'))) 
						{
							return true;
						}
						elseif(intval($deadLine->format('i')) == intval($current_date->format('i')))
						{
							//check second
							if (intval($deadLine->format('s')) >= intval($current_date->format('s'))) {
								return true;
							}
						}
					}
				}
			}
		}
		return false;
	}
} 

if( !function_exists('goodToken') )
{
	/**
	 * check if user's token is good
	 * @param  string $token user's token
	 * @param  string $pseudo    user's pseudo
	 * @return boolean           goodToken
	 */
	function goodToken( $token , $user )
	{
		//check if token is good 
		$current_token = sha1($user->pseudo . $user->email . $user->password );
		
		if( $token == $current_token )
		{
			return true;
		}
		return false;
	}
}

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