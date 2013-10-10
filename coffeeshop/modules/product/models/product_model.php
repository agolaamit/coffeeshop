<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends BF_Model
{

    protected $table = "product";
    protected $_tbl_product = "product";
    protected $_tbl_product_attr = "product_attributes";
    protected $_tbl_cat = "category";
    protected $_tbl_sub_cat = "sub_category";
    protected $_tbl_sub_cat_attr = "sub_category_attributes";
    protected $_tbl_sub_cat_attr_options = "sub_category_attributes_options";
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
    
    
    /**
     * Function save_url to add/update URL
     */
    function get_product_listing()
    {
        $this->db->select('Pro.*,Cat.category_name,Sub.sub_category_name');
        $this->db->from($this->_tbl_product.' as Pro');
        $this->db->join($this->_tbl_cat.' as Cat', 'Pro.cat_id = Cat.id', 'left');
        $this->db->join($this->_tbl_sub_cat.' as Sub', 'Pro.sub_cat_id = Sub.id', 'left');
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * Function get_cat_list to fetch all categories
     */
    function get_cat_list()
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_cat);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    /**
     * Function get_sub_cat_list_by_cafe_id to get listing of sub categories by cafe_id
     */
    function get_sub_cat_list_by_cafe_id()
    {
        $this->db->select('id,sub_category_name');
        $this->db->from($this->_tbl_sub_cat);
        $this->db->where('cafe_id', CAFE_ID);
        $query = $this->db->get();
        
        return $query->result_array();
    }    
    
    /**
     * Function save_option to add/update Option
     */
    public function save_product_attributes($data)
    {
        if (isset($data['id']))
        {
            $this->db->where('id', $data['id']);
            $this->db->update($this->_tbl_product_attr, $data);
            $id = $data['id'];
        }
        else
        {
            $this->db->insert($this->_tbl_product_attr, $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }       
    
    /**
     * Function update_product_attributes to update product attribute
     */
    public function update_product_attributes($data)
    {
        $this->db->where('product_id', $data['product_id']);
        $this->db->where('sub_cat_attr_option_id', $data['sub_cat_attr_option_id']);
        $this->db->update($this->_tbl_product_attr, $data);
            
        return true;
    }    
    
    /**
     * Function get_product_by_id to fetch details of product
     */
    function get_product_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_product);
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        $product = $query->row_array();
//        
//        $res = $this->get_product_attr_by_id($id);
//        if(!empty($res))
//        {
//            $product['attr'] = $res;
//        }
        return $product;
    }    
    
    /**
     * Function get_product_by_id to fetch details of product
     */
    function get_product_attr_by_id($id = 0)
    {
        $this->db->select('*');
        $this->db->from($this->_tbl_product_attr);
        $this->db->where('product_id', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    function delete_product($id = 0)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->_tbl_product);
        
        $this->db->where('product_id', $id);
        $this->db->delete($this->_tbl_product_attr); 
        
        return true;
    }
}
