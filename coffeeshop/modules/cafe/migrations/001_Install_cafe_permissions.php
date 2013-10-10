<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_cafe_permissions extends Migration {

	// permissions to migrate
	private $permission_values = array(
		array('name' => 'Cafe.Content.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Content.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Content.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Content.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Reports.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Reports.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Reports.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Reports.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Settings.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Settings.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Settings.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Settings.Delete', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Developer.View', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Developer.Create', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Developer.Edit', 'description' => '', 'status' => 'active',),
		array('name' => 'Cafe.Developer.Delete', 'description' => '', 'status' => 'active',),
	);

	//--------------------------------------------------------------------

	public function up()
	{
		$prefix = $this->db->dbprefix;

		// permissions
		foreach ($this->permission_values as $permission_value)
		{
			$permissions_data = $permission_value;
			$this->db->insert("permissions", $permissions_data);
			$role_permissions_data = array('role_id' => '1', 'permission_id' => $this->db->insert_id(),);
			$this->db->insert("role_permissions", $role_permissions_data);
		}
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$prefix = $this->db->dbprefix;

        // permissions
		foreach ($this->permission_values as $permission_value)
		{
			$query = $this->db->select('permission_id')->get_where("permissions", array('name' => $permission_value['name'],));
			foreach ($query->result_array() as $row)
			{
				$permission_id = $row['permission_id'];
				$this->db->delete("role_permissions", array('permission_id' => $permission_id));
			}
			$this->db->delete("permissions", array('name' => $permission_value['name']));

		}
	}

	//--------------------------------------------------------------------

}