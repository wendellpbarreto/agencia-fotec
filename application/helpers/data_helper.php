<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('not_empty'))
{
	function not_empty($value)
	{
		if ( ! empty($value))
			return true;
		return false;
	}
}

/**
 * Readable
 *
 * Converts mysql datetime to readable date format
 *
 * @access	public
 * @param	mixed
 * @return	array
 */	
if ( ! function_exists('readable'))
{	
	function readable($date)
	{
		$now = strtotime(date('Y-m-d h:i:s'));
		$otherDate = strtotime($date);
		$offset = $now - $otherDate;


		if($offset == 0){
			return "just now";
		}
		if($offset != null){
			$deltaS = $offset%60;
			$offset /= 60;
			$deltaM = $offset%60;
			$offset /= 60;
			$deltaH = $offset%24;
			$offset /= 24;
			$deltaD = ($offset > 1)?ceil($offset):$offset;		
		} else{
			throw new Exception("Must supply otherdate or offset (from now)");
		}
		if($deltaD > 1){
			if($deltaD > 365){
				$years = ceil($deltaD/365);
				if($years ==1){
					return "last year"; 
				} else{
					return "<br>$years years ago";
				}	
			}
			if($deltaD > 6){
				return date('d-M',strtotime("$deltaD days ago"));
			}		
			return "$deltaD days ago";
		}
		if($deltaD == 1){
			return "Yesterday";
		}
		if($deltaH == 1){
			return "last hour";
		}
		if($deltaM == 1){
			return "last minute";
		}
		if($deltaH > 0){
			return $deltaH." hours ago";
		}
		if($deltaM > 0){
			return $deltaM." minutes ago";
		}
		else{
			return "few seconds ago";
		}
		return date('l, jS \of F Y', strtotime($date));
	}
}

/**
 * Attr
 *
 * Generates an associative array from multiple params
 *
 * @access	public
 * @param	mixed
 * @return	array
 */	
if ( ! function_exists('attr'))
{	
	function attr()
	{
		$num_args = func_num_args();
		$val_args = func_get_args();

		for ($i = 0; $i < $num_args; $i++)
		{
			$actual = explode(':', $val_args[$i]);
			
			$key = $actual[0];
			$value = (isset($actual[1])) ? implode(' ', explode('|', $actual[1])) : '';

			$keys[] = $key;
			$values[] = $value;
		}

		return array_combine($keys, $values);
	}
}

/**
 * Garr
 *
 * Generates a array
 *
 * @access 	public
 * @param 	mixed
 * @return 	array
 */
if ( ! function_exists('garr'))
{
	function garr()
	{
		$num_args = func_num_args();
		$val_args = func_get_args();
		$array = array();

		for ($i = 0; $i < $num_args; $i++)
		{
			$actual = explode(':', $val_args[$i]);
			$values = (isset($actual[1])) ? explode('|', $actual[1]) : '';
			$array[$actual[0]] = $values;
		}

		return $array;
	}
}

/**
 * Aarr
 *
 * Generates an associative array
 *
 * @access 	public
 * @param 	mixed
 * @return 	array
 */
if ( ! function_exists('aarr'))
{
	function aarr()
	{
		$num_args = func_num_args();
		$val_args = func_get_args();
		$array = array();

		for ($i = 0; $i < $num_args/2; $i += 2)
		{
			$array[$val_args[$i]] = $val_args[$i+1];
		}

		return $array;
	}
}

/**
 * Get
 *
 * True if is a get request 
 *
 * @access public
 * @return boolean
 */
if ( ! function_exists('get'))
{
	function get()
	{
		return $_SERVER['REQUEST_METHOD'] == 'GET';
	}
}

/**
 * Post
 *
 * True if is a post request 
 *
 * @access public
 * @return boolean
 */
if ( ! function_exists('post'))
{
	function post()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}
}

/**
 * Generate Token
 *
 * Generates a random token
 *
 * @access public
 * @return boolean
 */
if ( ! function_exists('generateToken'))
{
	function generateToken($len) {
		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
			);
		shuffle($chars);

		$numChars = count($chars) - 1;
		$token = '';

		for ($i = 0; $i < $len; $i++)
			$token .= $chars[mt_rand(0, $numChars)];

		return $token;
	}
}

/* End of file data_helper.php */
/* Location: ./application/helpers/data_helper.php */