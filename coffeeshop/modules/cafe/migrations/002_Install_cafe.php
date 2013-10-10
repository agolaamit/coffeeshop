<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_cafe extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'cafe_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'cafe_url_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'cafe_status' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('cafe');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('cafe');

	}

	//--------------------------------------------------------------------

}