<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {

	public function login_attempt()
	{
		$this->load->library('encrypt');
		
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('deleted_at', NULL);
		
		$query = $this->db->get('users');
		$row = $query->row();

		if ($this->encrypt->decode($row->password) == $this->input->post('password'))
		{
			return $query->row();
		}
		else
		{
			return FALSE;
		}
	}

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);

		$query = $this->db->get('users');

		return $query->row();	
	}

	public function all($order = FALSE)
	{
		$this->db->where('deleted_at', NULL);

		if ($order) $this->db->order_by($order);
		$query = $this->db->get('users');

		return $query->result();
	}

	public function disabled()
	{
		$this->db->where('deleted_at IS NOT NULL');
		$query = $this->db->get('users');

		return $query->result();
	}

	public function save()
	{
		$this->load->library('encrypt');

		$this->data->name = $this->input->post('name');
		$this->data->type = $this->input->post('type');
		$this->data->email = $this->input->post('email');
		$this->data->password = $this->encrypt->encode($this->input->post('password'));
		$this->data->created_at = date('Y-m-d H:i:s');
		$this->data->updated_at = date('Y-m-d H:i:s');

		return $this->db->insert('users', $this->data);
	}

	public function update($id)
	{
		$this->load->library('encrypt');

		$this->data->name = $this->input->post('name');
		$this->data->type = $this->input->post('type');
		$this->data->email = $this->input->post('email');
		if (not_empty($this->input->post('password')))
			$this->data->password = $this->encrypt->encode($this->input->post('password'));
		$this->data->updated_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		return $this->db->update('users', $this->data);
	}

	public function delete($id)
	{
		$this->data->deleted_at = date('Y-m-d H:i:s');

		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->update('users', $this->data);
	}

	public function activate($id)
	{
		$this->data->updated_at = date('Y-m-d H:i:s');
		$this->data->deleted_at = NULL;
		
		$this->db->where('id', $id);
		return $this->db->update('users', $this->data);
	}

	public function hard_delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('users');
	}

	public function get_last()
	{
		$this->db->where('deleted_at', NULL);

		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('users');

		return $query->row();
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */