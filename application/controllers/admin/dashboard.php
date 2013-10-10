<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		parent::restrict(2);

		$this->load->helper('form');
		
		$this->template->set('nav', 0);
		$this->template->with('session_user', $this->session->userdata('session_user'));
	}

	/**
	 * Index Page for this controller.
	 *
	 * @return void
	 */
	public function index()
	{
		get()  ? $this->_getIndex() : '';
		post() ? $this->_postIndex() : '';
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions
	 * ----------------------------------------------------------------------
	 */

	# GET /dashboard/
	private function _getIndex()
	{
		$this->template->load('admin', 'admin/dashboard');
	}

	# POST /dashboard/
	private function _postIndex()
	{
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */