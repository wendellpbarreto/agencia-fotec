<?php

class Migration_Create_Categories_Table extends CI_Migration {

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

		$this->dbforge->create_table('categories');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->dbforge->drop_table('categories');
	}

}

/* End of file 001_create_categories_table.php */
/* Location: ./application/migrations/001_create_categories_table.php */