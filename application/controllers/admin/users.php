<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		parent::restrict(0);

		$this->load->helper('form');
		$this->load->helper('form_extended');

		$this->load->library('form_validation');

		$this->load->model('User_Model');
		
		$this->template->set('nav', 1);
		$this->template->with('session_user', $this->session->userdata('session_user'));
	}

	/**
	 * Index Page for this controller.
	 *
	 * @return void
	 */
	public function index()
	{
		get() ? $this->_getIndex() : '';
	}

	/**
	 * Create new user form
	 *
	 * @return void
	 */
	public function add()
	{
		get()  ? $this->_getAdd() : '';
		post() ? $this->_postAdd() : '';
	}

	/**
	 * Update existent user form
	 *
	 * @return void
	 */
	public function edit($id)
	{
		get()  ? $this->_getEdit($id) : '';
		post() ? $this->_postEdit($id) : '';
	}

	/**
	 * Delete existent user
	 *
	 * @return void
	 */
	public function delete($id)
	{
		get()  ? $this->_getDelete() : '';
		post() ? $this->_postDelete($id) : '';
	}

	/**
	 * Activate a deleted user
	 *
	 * @return void
	 */
	public function activate($id)
	{
		get()  ? $this->_getActivate() : '';
		post() ? $this->_postActivate($id) : '';
	}

	/**
	 * Hard delete a deleted existent user
	 *
	 * @return void
	 */
	public function hard_delete($id)
	{
		get()  ? $this->_getHardDelete() : '';
		post() ? $this->_postHardDelete($id) : '';
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Index)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/
	private function _getIndex()
	{
		$this->template->set('title', 'Listagem de Usuários');
		$this->template->with('users', $this->User_Model->all());
		$this->template->with('disabled_users', $this->User_Model->disabled());
		$this->template->load('admin', 'admin/users/index');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Add)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/add
	private function _getAdd()
	{
		$this->template->set('title', 'Adicionar Usuário');
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/users/add');
	}

	# POST /users/add
	private function _postAdd()
	{
		$this->form_validation->set_rules('name', 'nome', 'required');
		$this->form_validation->set_rules('type', 'tipo', 'required');
		$this->form_validation->set_rules('email', 'e-mail', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'senha', 'required|matches[confirmation]|min_length[8]|max_length[32]');

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->User_Model->save())
			{
				$this->session->set_flashdata(garr('messages:Usuário criado com sucesso'));
				redirect('admin/users');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu criando o usuário, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/users/add');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Edit)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/edit/(:num)
	private function _getEdit($id)
	{
		$this->template->set('title', 'Atualizando Usuário');
		$this->template->with('data', $this->User_Model->get($id));
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/users/edit');
	}

	# POST /users/edit/(:num)
	private function _postEdit($id)
	{
		$olddata = $this->db->get_where('users', array('id' => $id))->row();

		if ($this->input->post('name') != $olddata->name)
			$this->form_validation->set_rules('name', 'nome', 'required');
		if ($this->input->post('type') != $olddata->type)
			$this->form_validation->set_rules('type', 'tipo', 'required');
		if ($this->input->post('email') != $olddata->email)
			$this->form_validation->set_rules('email', 'e-mail', 'required|is_unique[users.email]');
		if ($this->input->post('password') != $olddata->password)
			$this->form_validation->set_rules('password', 'senha', 'matches[confirmation]|min_length[8]|max_length[32]');

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->User_Model->update($id))
			{
				$this->session->set_flashdata(garr('messages:Usuário atualizado com sucesso'));
				redirect('admin/users');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu atualizando o usuário, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/users/edit/'.$id);
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Delete)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/delete/(:num)
	private function _getDelete()
	{
		$this->template->set('home', 'admin/users');
		$this->template->load('blank', 'error404');
	}

	# POST /users/delete/(:num)
	private function _postDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->User_Model->delete($id))
			{
				print(TRUE);
			}
			else
			{
				print(FALSE);
			}
		}
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Activate)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/activate/(:num)
	private function _getActivate()
	{
		$this->template->set('home', 'admin/users');
		$this->template->load('blank', 'error404');
	}

	# POST /users/activate/(:num)
	private function _postActivate($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->User_Model->activate($id))
			{
				print(TRUE);
			}
			else
			{
				print(FALSE);
			}
		}
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Hard Delete)
	 * ----------------------------------------------------------------------
	 */

	# GET /users/hard_delete/(:num)
	private function _getHardDelete()
	{
		$this->template->set('home', 'admin/users');
		$this->template->load('blank', 'error404');
	}

	# POST /users/hard_delete/(:num)
	private function _postHardDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->User_Model->hard_delete($id))
			{
				print(TRUE);
			}
			else
			{
				print(FALSE);
			}
		}
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */