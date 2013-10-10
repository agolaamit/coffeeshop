<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_category_model extends BF_Model
{

    protected $table = "sub_category";
    protected $_tbl_sub_cat = "sub_category";
    protected $_tbl_sub_cat_attr = "sub_category_attributes";
    protected $_tbl_sub_cat_attr_options = "sub_category_attributes_options";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    
    
    function get_subcategories_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat);
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    function get_attribute_by_sub_cat_id($id = 0)
    {
        $this->db->select('Attr.*,Sub.sub_category_name');
        $this->db->from($this->_tbl_sub_cat_attr.' as Attr');
        $this->db->join($this->_tbl_sub_cat.' as Sub', 'Attr.sub_cat_id = Sub.id', 'left');
        $this->db->where('Attr.sub_cat_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * Function save_url to add/update URL
     */
    public function save_attributes($data)
    {
        if (isset($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update($this->_tbl_sub_cat_attr, $data);
            $id = $data['id'];
        }
        else
        {
            $this->db->insert($this->_tbl_sub_cat_attr, $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }
    
    
    
    function get_attribute_details_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat_attr);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function delete_attribute($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_tbl_sub_cat_attr); 
        
        return true;
    }
    
    
    
    function get_option_by_attr_id($id = 0)
    {
        $this->db->select('Opt.*,Attr.attribute_name');
        $this->db->from($this->_tbl_sub_cat_attr_options.' as Opt');
        $this->db->join($this->_tbl_sub_cat_attr.' as Attr', 'Opt.sub_cat_attr_id = Attr.id', 'left');
        $this->db->where('Opt.sub_cat_attr_id ', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * Function save_option to add/update Option
     */
    public function save_option($data)
    {
        if (isset($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update($this->_tbl_sub_cat_attr_options, $data);
            $id = $data['id'];
        }
        else
        {
            $this->db->insert($this->_tbl_sub_cat_attr_options, $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }    
    
    function get_option_details_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat_attr_options);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }    
    
    function delete_option($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_tbl_sub_cat_attr_options); 
        
        return true;
    }
    
    function get_cafe_id_by_sub_cat_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat_attr_options);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function get_subcategories_dropdown($cat_id = 0)
    {
        $this->db->select('id,sub_category_name');
        $this->db->from($this->_tbl_sub_cat);
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    function get_attribute_structure($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat_attr);
        $this->db->where('sub_cat_id', $id);
        $query = $this->db->get();
        
        $sub_list = $query->result_array();
        
        $i = 0;
        foreach($sub_list as $sub)
        {
            $result = $this->get_option_list_by_id($sub['id']);
            $sub_list[$i]['options'] = $result;
            $i++;
        }
        
        return $sub_list;
    }
    
      
    
    function get_option_list_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_sub_cat_attr_options);
        $this->db->where('sub_cat_attr_id', $id);
        $query = $this->db->get();
                
        return $query->result_array();
    }   

}
