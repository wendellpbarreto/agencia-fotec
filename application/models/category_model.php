<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Model extends CI_Model {

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);

		$query = $this->db->get('categories');

		return $query->row();	
	}

	public function all($order = FALSE)
	{
		$this->db->where('deleted_at', NULL);

		if ($order) $this->db->order_by($order);
		$query = $this->db->get('categories');

		return $query->result();
	}

	public function disabled()
	{
		$this->db->where('deleted_at IS NOT NULL');
		$query = $this->db->get('categories');

		return $query->result();
	}

	public function save()
	{
		$this->data->name = $this->input->post('name');
		$this->data->created_at = date('Y-m-d H:i:s');
		$this->data->updated_at = date('Y-m-d H:i:s');

		return $this->db->insert('categories', $this->data);
	}

	public function update($id)
	{
		$this->data->name = $this->input->post('name');
		$this->data->updated_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		return $this->db->update('categories', $this->data);
	}

	public function delete($id)
	{
		$this->data->deleted_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->update('categories', $this->data);
	}

	public function activate($id)
	{
		$this->data->updated_at = date('Y-m-d H:i:s');
		$this->data->deleted_at = NULL;
		
		$this->db->where('id', $id);
		return $this->db->update('categories', $this->data);
	}

	public function hard_delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('categories');
	}

	public function get_last()
	{
		$this->db->where('deleted_at', NULL);

		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('categories');

		return $query->row();
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */