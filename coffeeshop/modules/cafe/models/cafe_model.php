<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cafe_model extends BF_Model
{

    protected $table = "cafe";
    protected $_tbl_cafe = "cafe";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    
    public function get_cafe_listing($id = NULL)
    {
        if (empty($id) || !is_integer($id))
        {
            return FALSE;
        }

        $role = parent::find($id);

        if ($role == FALSE)
        {
            return FALSE;
        }

        $this->get_role_permissions($role);

        return $role;
    }
    
    
    function get_cafe_dropdown()
    {
        $this->db->select('id,cafe_name');
        $this->db->from($this->_tbl_cafe);
        $this->db->where('cafe_status', 0);
        $query = $this->db->get();
        
        return $query->result_array();
    }

}
