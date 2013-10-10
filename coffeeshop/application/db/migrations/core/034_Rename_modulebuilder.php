<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Rename_modulebuilder extends Migration {
	
	public function up() 
	{
		$this->db->where('name', 'Coffeeshop.Modulebuilder.View')
				 ->set('name', 'Coffeeshop.Builder.View')
				 ->update('permissions');
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
		$this->db->where('name', 'Coffeeshop.Builder.View')
				 ->set('name', 'Coffeeshop.Modulebuilder.View')
				 ->update('permissions');
	}
	
	//--------------------------------------------------------------------
}