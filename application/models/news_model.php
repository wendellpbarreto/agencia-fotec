<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_Model extends CI_Model {

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);

		$query = $this->db->get('news');

		return $query->row();	
	}

	public function all($order = FALSE)
	{
		$this->db->where('revised', 1);
		$this->db->where('categories.deleted_at', NULL);
		$this->db->where('news.deleted_at', NULL);

		$this->db->select('news.*, categories.name as category');
		$this->db->join('categories', 'news.category_id = categories.id');

		if ($order) $this->db->order_by($order);
		$query = $this->db->get('news');

		return $query->result();
	}

	public function unpublished($order = FALSE)
	{
		$this->db->where('revised', 0);
		$this->db->where('categories.deleted_at', NULL);
		$this->db->where('news.deleted_at', NULL);

		$this->db->select('news.*, categories.name as category');
		$this->db->join('categories', 'news.category_id = categories.id');

		if ($order) $this->db->order_by($order);
		$query = $this->db->get('news');

		return $query->result();
	}

	public function disabled()
	{
		$this->db->where('categories.deleted_at', NULL);
		$this->db->where('news.deleted_at IS NOT NULL');

		$this->db->select('news.*, categories.name as category');
		$this->db->join('categories', 'news.category_id = categories.id');

		$query = $this->db->get('news');

		return $query->result();
	}

	public function save()
	{
		$this->data->title = $this->input->post('title');
		$this->data->slug = $this->verify_slug();
		$this->data->subtitle = $this->input->post('subtitle');
		$this->data->content = $this->input->post('content');
		$this->data->category_id = $this->input->post('category_id');
		$this->data->featured = $this->input->post('featured');
		$this->data->extension = array_pop(explode('.', $_FILES['cover']['name']));
		if (user_is('revisor'))
		{
			$this->data->user_id = $this->input->post('user_id');
			$this->data->revised = $this->input->post('revised');
		}
		else
		{
			$this->data->user_id = $this->session->userdata('session_user');
			$this->data->revised = 0;
		}
		$this->data->created_at = date('Y-m-d H:i:s');
		$this->data->updated_at = date('Y-m-d H:i:s');

		return $this->db->insert('news', $this->data);
	}

	public function update($id)
	{
		$this->data->title = $this->input->post('title');
		$this->data->subtitle = $this->input->post('subtitle');
		$this->data->content = $this->input->post('content');
		$this->data->category_id = $this->input->post('category_id');
		$this->data->featured = $this->input->post('featured');
		if ($_FILES['cover']['size'])
		{
			$this->data->extension = array_pop(explode('.', $_FILES['cover']['name']));
		}
		if (user_is('revisor'))
		{
			$this->data->user_id = $this->input->post('user_id');
			$this->data->revised = $this->input->post('revised');
		}
		else
		{
			$this->data->user_id = $this->session->userdata('session_user');
			$this->data->revised = 0;
		}
		$this->data->created_at = date('Y-m-d H:i:s');
		$this->data->updated_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		return $this->db->update('news', $this->data);
	}

	public function delete($id)
	{
		$this->data->deleted_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->update('news', $this->data);
	}

	public function activate($id)
	{
		$this->data->updated_at = date('Y-m-d H:i:s');
		$this->data->deleted_at = NULL;
		
		$this->db->where('id', $id);
		return $this->db->update('news', $this->data);
	}

	public function hard_delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('news');
	}

	public function get_last()
	{
		$this->db->where('deleted_at', NULL);

		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('news');

		return $query->row();
	}

	public function verify_slug()
	{
		$slug = generate_slug($this->input->post('title'));

		$rows = $this->db->where('slug', $slug)
						 ->or_where('slug LIKE', $slug . '-_')
						 ->get('news')
						 ->result();
						 
		if (count($rows) === 0)
		{
			return $slug;
		}
		else
		{
			$slug = array_pop($rows)->slug;
			$slug = explode('-', $slug);
			$index = intval(array_pop($slug)) + 1;
			$slug[] = strval($index);
			$slug = implode('-', $slug);
			return $slug;
		}

	}

}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */