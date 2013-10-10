<?php

class Migration_Create_Users_Table extends CI_Migration {

	/**
	 * Run the migration
	 *
	 * @return void
	 */
	public function up() {
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 64
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => 128
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 128
			),
			'type' => array(
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => TRUE
			),
			'created_at' => array(
				'type' => 'DATETIME'
			),
			'updated_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
 			),
			'deleted_at' => array(
				'type' => 'DATETIME',
				'null' => TRUE
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('users');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->dbforge->drop_table('users');
	}

}

/* End of file 001_create_users_table.php */
/* Location: ./application/migrations/001_create_users_table.php */