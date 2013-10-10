<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		parent::restrict(2);

		$this->load->helper('form');
		$this->load->helper('form_extended');

		$this->load->library('form_validation');

		$this->load->model('Category_Model');
		$this->load->model('News_Model');
		$this->load->model('User_Model');
		
		$this->template->set('nav', 4);
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
		parent::restrict(1);
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

	/**
	 * Validates the file to upload
	 *
	 * @return void
	 */
	public function _validateUpload()
	{
		$valid = TRUE;

		$allowed_types = array(
			'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif'
		);

		$file_extension = array_pop(explode('.', $_FILES['cover']['name']));

		if ( ! array_key_exists($file_extension, $allowed_types))
		{
			$valid = FALSE;
		}
		if ( ! in_array($_FILES['cover']['type'], $allowed_types))
		{
			$valid = FALSE;
		}
		if ( ! $_FILES['cover']['size'])
		{
			$valid = FALSE;
		}

		return $valid;
	}

	/**
	 * Return the file upload configuration array
	 *
	 * @return array
	 */
	public function _configUpload($id)
	{
		$foldername = './storage/covers/';
		$file_extension = array_pop(explode('.', $_FILES['cover']['name']));

		$config['upload_path'] = $foldername;
		$config['allowed_types'] = '*';
		$config['file_name'] = 'cover-' . $id . '.' . $file_extension;
		$config['max_size'] = '4194304';
		$config['overwrite'] = TRUE;

		return $config;
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Index)
	 * ----------------------------------------------------------------------
	 */

	# GET /news/
	private function _getIndex()
	{
		$this->template->set('title', 'Listagem de Notícias');
		$this->template->with('news', $this->News_Model->all());
		$this->template->with('unpublished_news', $this->News_Model->unpublished());
		$this->template->with('disabled_news', $this->News_Model->disabled());
		$this->template->load('admin', 'admin/news/index');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Add)
	 * ----------------------------------------------------------------------
	 */

	# GET /news/add
	private function _getAdd()
	{
		$this->template->set('title', 'Adicionar Notícia');
		$this->template->with('categories', $this->Category_Model->all());
		$this->template->with('users', $this->User_Model->all());
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/news/add');
	}

	# POST /news/add
	private function _postAdd()
	{
		$this->form_validation->set_rules('title', 'título', 'required|max_length[100]');
		$this->form_validation->set_rules('subtitle', 'subtítulo', 'required|max_length[200]');
		$this->form_validation->set_rules('content', 'conteúdo', 'required');
		$this->form_validation->set_rules('category_id', 'editorial', 'required');
		if (user_is('revisor'))
		{
			$this->form_validation->set_rules('user_id', 'autor', 'required');
		}

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->News_Model->save())
			{
				$last = $this->News_Model->get_last();
				$this->load->library('upload', $this->_configUpload($last->id));
				if ( ! $this->_validateUpload() OR ! $this->upload->do_upload('cover'))
				{
					if ($this->upload->display_errors())
						$this->session->set_flashdata(garr('errors:'.$this->upload->display_errors()));
				}
				
				$this->session->set_flashdata(garr('messages:Notícia criada com sucesso'));
				redirect('admin/news');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu criando a notícia, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/news/add');
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Edit)
	 * ----------------------------------------------------------------------
	 */

	# GET /news/edit/(:num)
	private function _getEdit($id)
	{
		$this->template->set('title', 'Atualizando Notícia');
		$this->template->with('categories', $this->Category_Model->all());
		$this->template->with('users', $this->User_Model->all());
		$this->template->with('data', $this->News_Model->get($id));
		$this->template->with('post', $this->session->flashdata('post'));
		$this->template->load('admin', 'admin/news/edit');
	}

	# POST /news/edit/(:num)
	private function _postEdit($id)
	{
		$olddata = $this->db->get_where('news', array('id' => $id))->row();

		if ($this->input->post('title') != $olddata->title)
			$this->form_validation->set_rules('title', 'título', 'required');
		if ($this->input->post('subtitle') != $olddata->subtitle)
			$this->form_validation->set_rules('subtitle', 'subtítulo', 'required');
		if ($this->input->post('content') != $olddata->content)
			$this->form_validation->set_rules('content', 'conteúdo', 'required');
		if ($this->input->post('category_id') != $olddata->category_id)
			$this->form_validation->set_rules('category_id', 'editorial', 'required');

		if ( ! $this->form_validation->run())
		{
			$this->session->set_flashdata(garr('errors:'.validation_errors()));
			$this->session->set_flashdata(aarr('post', $this->input->post()));
		}
		else
		{
			if ($status = $this->News_Model->update($id))
			{
				$this->load->library('upload', $this->_configUpload($id));
				if ( ! $this->_validateUpload() OR ! $this->upload->do_upload('cover'))
				{
					if ($this->upload->display_errors())
						$this->session->set_flashdata(garr('errors:'.$this->upload->display_errors()));
				}

				$this->session->set_flashdata(garr('messages:Notícia atualizada com sucesso'));
				redirect('admin/news');
			}
			else
			{
				$this->session->set_flashdata(garr('errors:Um erro desconhecido aconteceu atualizando a notícia, tente novamente mais tarde'));
				$this->session->set_flashdata(aarr('post', $this->input->post()));
			}
		}

		redirect('admin/news/edit/'.$id);
	}

	/*
	 * ---------------------------------------------------------------------- 
	 * Real Actions (Delete)
	 * ----------------------------------------------------------------------
	 */

	# GET /news/delete/(:num)
	private function _getDelete()
	{
		$this->template->set('home', 'admin/news');
		$this->template->load('blank', 'error404');
	}

	# POST /news/delete/(:num)
	private function _postDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->News_Model->delete($id))
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

	# GET /news/activate/(:num)
	private function _getActivate()
	{
		$this->template->set('home', 'admin/news');
		$this->template->load('blank', 'error404');
	}

	# POST /news/activate/(:num)
	private function _postActivate($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->News_Model->activate($id))
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

	# GET /news/hard_delete/(:num)
	private function _getHardDelete()
	{
		$this->template->set('home', 'admin/news');
		$this->template->load('blank', 'error404');
	}

	# POST /news/hard_delete/(:num)
	private function _postHardDelete($id)
	{
		if ($this->input->post('id') == $id)
		{
			if ($status = $this->News_Model->hard_delete($id))
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

/* End of file news.php */
/* Location: ./application/controllers/news.php */