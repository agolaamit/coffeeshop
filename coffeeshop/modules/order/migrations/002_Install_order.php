<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_order extends Migration {

	public function up()
	{
		$prefix = $this->db->dbprefix;

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE,
			),
			'order_userid' => array(
				'type' => 'INT',
				'constraint' => 11,
				
			),
			'order_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255,
				
			),
			'order_items' => array(
				'type' => 'TEXT',
				
			),
			'order_total' => array(
				'type' => 'FLOAT',
				'constraint' => 10,2,
				
			),
			'order_createdtime' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
			'order_pickuptime' => array(
				'type' => 'DATETIME',
				'default' => '0000-00-00 00:00:00',
				
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('order');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

		$this->dbforge->drop_table('order');

	}

	//--------------------------------------------------------------------

}