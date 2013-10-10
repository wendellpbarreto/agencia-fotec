<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		parent::restrict(0);

		$this->load->helper('form');
		$this->load->helper('form_extended');

		$this->load->library('form_validation');

		$this->load->model('Category_Model');
		
		$this->template->set('nav', 3);
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

	# GET /categories/
	private function _getIndex()
	{
		$this->template->set('title', 'Listagem de Editoriais');
		$this->template->with('categories', $this->Category_Model->all());
		$this->template->with('disabled_categories', $this->Category_Model->disabled());
		$this->template->load('admin', 'admin/categories/index');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Add)
	 * ----------------------------------------------------------------------
	 */

	# GET /categories/add
	private function _getAdd()
	{
		$this->template->set('title', 'Adicionar Editorial');
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/categories/add');
	}

	# POST /categories/add
	private function _postAdd()
	{
		$this->form_validation->set_rules('name', 'nome', 'required');

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->Category_Model->save())
			{
				$this->session->set_flashdata(garr('messages:Editorial criado com sucesso'));
				redirect('admin/categories');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu criando o editorial, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/categories/add');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Edit)
	 * ----------------------------------------------------------------------
	 */

	# GET /categories/edit/(:num)
	private function _getEdit($id)
	{
		$this->template->set('title', 'Atualizando Editorial');
		$this->template->with('data', $this->Category_Model->get($id));
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/categories/edit');
	}

	# POST /categories/edit/(:num)
	private function _postEdit($id)
	{
		$olddata = $this->db->get_where('categories', array('id' => $id))->row();

		if ($this->input->post('name') != $olddata->name)
			$this->form_validation->set_rules('name', 'nome', 'required');

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->Category_Model->update($id))
			{
				$this->session->set_flashdata(garr('messages:Editorial atualizado com sucesso'));
				redirect('admin/categories');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu atualizando o editorial, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/categories/edit/'.$id);
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Delete)
	 * ----------------------------------------------------------------------
	 */

	# GET /categories/delete/(:num)
	private function _getDelete()
	{
		$this->template->set('home', 'admin/categories');
		$this->template->load('blank', 'error404');
	}

	# POST /categories/delete/(:num)
	private function _postDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->Category_Model->delete($id))
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

	# GET /categories/activate/(:num)
	private function _getActivate()
	{
		$this->template->set('home', 'admin/categories');
		$this->template->load('blank', 'error404');
	}

	# POST /categories/activate/(:num)
	private function _postActivate($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->Category_Model->activate($id))
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

	# GET /categories/hard_delete/(:num)
	private function _getHardDelete()
	{
		$this->template->set('home', 'admin/categories');
		$this->template->load('blank', 'error404');
	}

	# POST /categories/hard_delete/(:num)
	private function _postHardDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->Category_Model->hard_delete($id))
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

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */