<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class settings extends Admin_Controller
{

    //--------------------------------------------------------------------


    public function __construct()
    {
        parent::__construct();
        //$this->auth->restrict('Product.Settings.View');
        $this->load->model('product_model', null, true);
        $this->load->model('sub_category/sub_category_model', null, true);
        $this->lang->load('product');

        Template::set_block('sub_nav', 'settings/_sub_nav');
    }

    //--------------------------------------------------------------------



    /*
      Method: index()

      Displays a list of form data.
     */
    public function index()
    {
        // Deleting anything?
        if (isset($_POST['delete']))
        {
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked))
            {
                $result = FALSE;
                foreach ($checked as $pid)
                {
                    $result = $this->product_model->delete_product($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('product_delete_success'), 'success');
                }
                else
                {
                    Template::set_message(lang('product_delete_failure') . $this->product_model->error, 'error');
                }
            }
        }

        $records = $this->product_model->get_product_listing();
        
        Template::set('records', $records);
        Template::set('toolbar_title', 'Manage Product');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: create()

      Creates a Product object.
     */
    public function create()
    {
        if ($this->input->post('save'))
        {
            if ($insert_id = $this->save_product())
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('product_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'product');

                Template::set_message(lang('product_create_success'), 'success');
                Template::redirect(SITE_AREA . '/settings/product');
            }
            else
            {
                Template::set_message(lang('product_create_failure') . $this->product_model->error, 'error');
            }
        }
        Assets::add_module_js('product', 'product.js');

        $category_list = $this->product_model->get_cat_list();
        Template::set('category_list', $category_list);
        
        $sub_category_list = $this->product_model->get_sub_cat_list_by_cafe_id();
        Template::set('sub_category_list', $sub_category_list);
        
        Template::set('toolbar_title', lang('product_create') . ' Product');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: edit()

      Allows editing of Product data.
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        
        if (empty($id))
        {
            Template::set_message(lang('product_invalid_id'), 'error');
            redirect(SITE_AREA . '/settings/product');
        }

        if (isset($_POST['save']))
        {
            if ($this->save_product('update', $id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('product_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'product');

                Template::set_message(lang('product_edit_success'), 'success');
            }
            else
            {
                Template::set_message(lang('product_edit_failure') . $this->product_model->error, 'error');
            }
        }
        else if (isset($_POST['delete']))
        {
            $this->auth->restrict('Product.Settings.Delete');

            if ($this->product_model->delete($id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('product_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'product');

                Template::set_message(lang('product_delete_success'), 'success');

                redirect(SITE_AREA . '/settings/product');
            }
            else
            {
                Template::set_message(lang('product_delete_failure') . $this->product_model->error, 'error');
            }
        }
        
        $category_list = $this->product_model->get_cat_list();
        Template::set('category_list', $category_list);
        
        $sub_category_list = $this->product_model->get_sub_cat_list_by_cafe_id();
        Template::set('sub_category_list', $sub_category_list);
        
        $product = $this->product_model->get_product_by_id($id);
        //pre($product);
        Template::set('product', $product);
        Assets::add_module_js('product', 'product.js');

        Template::set('toolbar_title', lang('product_edit') . ' Product');
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_product()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_product($type = 'insert', $id = 0)
    {   
        if ($type == 'update')
        {
            $_POST['id'] = $id;
            $this->form_validation->set_rules('product_name', 'Product name', 'required|is_unique[bf_product.product_name,bf_product.sub_cat_id,bf_product.id]|trim|max_length[255]');
        }
        else
        {
            $this->form_validation->set_rules('product_name', 'Product name', 'required|unique[bf_product.product_name,bf_product.id]|trim|max_length[255]');
        }


        
        $this->form_validation->set_rules('cat_id', 'Category', 'required|max_length[11]');
        $this->form_validation->set_rules('sub_cat_id', 'Sub Category', 'required|max_length[11]');
        $this->form_validation->set_rules('price', 'Description', 'required|max_length[11]');

        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }
        $product = $this->input->post();
        
        // make sure we only pass in the fields we want

        $data = array();
        $data['product_name'] = $product['product_name'];
        $data['cat_id'] = $product['cat_id'];
        $data['sub_cat_id'] = $product['sub_cat_id'];
        $data['price'] = $product['price'];
        $data['cafe_id'] = CAFE_ID;
        
        if ($type == 'insert')
        {
            $id = $this->product_model->insert($data);

            foreach($product as $key=>$value)
            {
                if(is_numeric($key))
                {
                    $product_attr = array();
                    $product_attr['product_id'] = $id;
                    $product_attr['sub_cat_attr_option_id'] = $key;
                    $product_attr['extra_price'] = $value;
                    
                    $this->product_model->save_product_attributes($product_attr);
                }
            }
            if (is_numeric($id))
            {
                $return = $id;
            }
            else
            {
                $return = FALSE;
            }
        }
        else if ($type == 'update')
        {
            $return = $this->product_model->update($id, $data);
            
            foreach($product as $key=>$value)
            {
                if(is_numeric($key))
                {
                    $product_attr = array();
                    $product_attr['product_id'] = $id;
                    $product_attr['sub_cat_attr_option_id'] = $key;
                    $product_attr['extra_price'] = $value;
                    
                    $this->product_model->update_product_attributes($product_attr);
                }
            }
        }

        return $return;
    }
    
    /*
      Method: get_sub_cat_dropdown()

      Creates a Sub category dropdown
     */
    public function get_sub_cat_dropdown()
    {
        $cat_id = 0;
        if ($this->input->post('cat_id'))
        {
            $cat_id = $this->input->post('cat_id');
        }

        $sub_cat_dropdown = $this->sub_category_model->get_subcategories_dropdown($cat_id);
        Template::set('sub_cat_dropdown', $sub_cat_dropdown);
        
        Template::render();
    }
    
    /*
      Method: get_attribute_listing()

      Creates a attribute listing
     */
    public function get_attribute_listing()
    {
        $sub_cat_id = 1;
        if ($this->input->post('sub_cat_id'))
        {
            $sub_cat_id = $this->input->post('sub_cat_id');
        }
        $product = array();
        if ($this->input->post('product_id'))
        {
            $product = $this->product_model->get_product_attr_by_id($this->input->post('product_id'));
        }
        
        Template::set('product', $product);
        
        $sub_cat_dropdown = $this->sub_category_model->get_attribute_structure($sub_cat_id);
        Template::set('sub_cat_dropdown', $sub_cat_dropdown);
        
        Template::render();
    }

    //--------------------------------------------------------------------
}