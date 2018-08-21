<?php



if( !function_exists('replace_attribute_to_field_name') )
{
	/**
	 * replace :attribute in the msg to the fieldName
	 * @param  string $fieldName field name to introduce in the msg
	 * @param  string $msg       origin msg
	 * @return string            new msg 
	 */
	function getMessgae( $fieldName, $msg, $min=3)
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


if( !function_exists('not_empty') )
{
	function not_empty( $fields )
	{
		include_once(__DIR__.'/include_lang_files.php');

		$error_fields = [];
		foreach($fields as $key => $value )
		{
			if( empty($value) )
			{
				$error_fields[$key] = getMessgae($lang['form']['field'][$key],$lang['form']['message']['required'] );
			}
		}
		return $error_fields;
	}
}