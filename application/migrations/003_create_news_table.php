<?php

class Migration_Create_News_Table extends CI_Migration {

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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
			),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => 200
			),
			'subtitle' => array(
				'type' => 'VARCHAR',
				'constraint' => 300
			),
			'content' => array(
				'type' => 'TEXT'
			),
			'revised' => array(
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => TRUE
			),
			'featured' => array(
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => TRUE
			),
			'extension' => array(
				'type' => 'VARCHAR',
				'constraint' => 4
			),
			'category_id' => array(
				'type' => 'int',
				'constraint' => 5,
				'unsigned' => TRUE
			),
			'user_id' => array(
				'type' => 'int',
				'constraint' => 5,
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

		$this->dbforge->create_table('news');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		$this->dbforge->drop_table('news');
	}

}

/* End of file 001_create_news_table.php */
/* Location: ./application/migrations/001_create_news_table.php */