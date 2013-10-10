<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_slug'))
{
	setlocale(LC_ALL, 'en_US.UTF8');
	function generate_slug($str, $replace=array(), $delimiter='-') {
		if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
}

if ( ! function_exists('user_is'))
{
	function user_is($class)
	{
		$ci =& get_instance();
		$access_level = array_search($class, user_types(TRUE));

		if ($access_level == FALSE)
		{
			$access_level = -1;
		}
		if ($ci->session->userdata('session_user')->type <= $access_level)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

if ( ! function_exists('user_types'))
{
	function user_types($coded = FALSE)
	{
		if ($coded)
		{
			return array(
				'admin',
				'revisor',
				'user'
			);
		}
		else 
		{
			return array(
				'Administrador',
				'Revisor',
				'Usuário Comum'
			);
		}
	}
}

if ( ! function_exists('partial'))
{
	function partial($file)
	{
		$file = "_{$file}.php";
		return $file;
	}
}

if ( ! function_exists('extract_column'))
{
	function extract_column($matrix, $index = 'id')
	{
		$column = array();
		foreach ($matrix as $row) {
			$column[] = $row->$index;
		}
		return $column;
	}
}

/* End of file default_helper.php */
/* Location: ./application/helpers/default_helper.php */