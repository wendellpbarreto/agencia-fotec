<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_Model');

		$this->load->helper('data');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	/**
	 * Index Page for this controller.
	 *
	 * @return void
	 */
	public function index()
	{
		parent::non_restrict();
		get()  ? $this->_getIndex() : '';
		post() ? $this->_postIndex() : '';
	}

	/**
	 * Log the user out.
	 *
	 * @return void
	 */
	public function logout()
	{
		parent::restrict(2);
		get()  ? $this->_getLogout() : '';
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Index / Login)
	 * ----------------------------------------------------------------------
	 */

	# GET /admin/auth
	private function _getIndex()
	{
		$this->template->load('blank', 'admin/auth');
	}

	# POST /admin/auth
	private function _postIndex()
	{
		if ($login = $this->User_Model->login_attempt())
		{
			$this->session->set_userdata('session_user', $login);
			redirect('admin');
		}
		else
		{
			$this->session->set_flashdata(garr('errors:As informações de login estão incorretas'));
			redirect('admin/auth');
		}
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Logout)
	 * ----------------------------------------------------------------------
	 */

	# GET /admin/auth/logout
	private function _getLogout()
	{
		$this->session->unset_userdata('session_user');
		$this->session->set_flashdata(garr('messages:Você fez logout com sucesso'));
		redirect('admin/auth');
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */