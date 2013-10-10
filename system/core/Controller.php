<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class

class Base_Controller extends CI_Controller {

	protected static $_data;

	public function __construct()
	{
		parent::__construct();

		self::$_data = array();

		$this->template->with('messages', $this->session->flashdata('messages'));
		$this->template->with('errors', $this->session->flashdata('errors'));
	}

	/**
	 * Look for data requested or add data
	 *
	 * @return data requested | void
	 */
	protected static function data($value = FALSE)
	{
		if (sizeof(func_get_args()) > 1)
		{
			return self::$_data[func_get_arg(0)] = func_get_arg(1);
		}

		if ( ! is_array($value))
		{
			if ($value === FALSE)
			{
				return self::$_data;
			}
			if (isset(self::$_data[$value]))
			{
				return self::$_data[$value];
			}
			if (strstr($value, ':|:'))
			{
				$split = explode(':|:', $value);
				return self::$_data[$split[0]] = $split[1];
			}
		}

		self::$_data = array_merge(self::$_data, $value);
	}

	public function restrict($role)
	{
		if ($user = $this->session->userdata('session_user'))
		{
			if ($role >= $user->type)
			{
				return;
			}
			else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		redirect('admin/auth');
	}

	public function non_restrict()
	{
		if ($this->session->userdata('session_user'))
			redirect('admin/');
	}

}

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */