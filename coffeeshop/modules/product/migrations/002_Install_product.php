<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_product extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'product_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'product_category' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'product_sub_category' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'product_description' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('product');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('product');

	}

	//--------------------------------------------------------------------

}