<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class settings extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth->restrict('Sub_Category.Settings.View');
        $this->load->model('sub_category_model', null, true);
        $this->load->model('cafe/cafe_model', null, true);
        $this->lang->load('sub_category');

        Template::set_block('sub_nav', 'settings/_sub_nav');
    }

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
                    $result = $this->sub_category_model->delete($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_delete_success'), 'success');
                } else
                {
                    Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
                }
            }
        }

        $records = $this->sub_category_model->find_all();

        Template::set('records', $records);
        Template::set('toolbar_title', 'Manage Sub Category');
        Template::render();
    }
    
    /*
      Method: listing()

      Displays a list of sub category data.
     */
    public function listing($id = 0)
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
                    $result = $this->sub_category_model->delete($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_delete_success'), 'success');
                } else
                {
                    Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
                }
            }
        }

        $records = $this->sub_category_model->get_subcategories_by_id($id);

        Template::set('records', $records);
        Template::set('toolbar_title', 'Manage Sub Category');
        Template::render();
    }

    /*
      Method: attribute_listing()

      Displays a list of form data.
     */

    public function attribute_listing($id = 0)
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
                    $result = $this->sub_category_model->delete_attribute($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_delete_success'), 'success');
                    redirect(SITE_AREA . '/settings/sub_category/attribute_listing/' . $id);
                } else
                {
                    Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
                }
            }
        }

        $records = $this->sub_category_model->get_attribute_by_sub_cat_id($id);

        Template::set('records', $records);
        Template::set('toolbar_title', 'Sub Category Attributes');
        Template::render();
    }

    /*
      Method: create()

      Creates a Sub Category object.
     */

    public function create()
    {
        $this->auth->restrict('Sub_Category.Settings.Create');

        if ($this->input->post('save'))
        {
            if ($insert_id = $this->save_sub_category())
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message(lang('sub_category_create_success'), 'success');
                Template::redirect(SITE_AREA . '/settings/sub_category/listing/'.$this->uri->segment(5));
            } else
            {
                Template::set_message(lang('sub_category_create_failure') . $this->sub_category_model->error, 'error');
            }
        }
        
        Template::set('cafe_list', $this->cafe_model->get_cafe_dropdown());
        
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_create') . ' Sub Category');
        Template::render();
    }

/*
      Method: edit()

      Allows editing of Sub Category data.
     */

    public function edit()
    {
        $cat_id = $this->uri->segment(5);
        $id = $this->uri->segment(6);

        if (empty($id))
        {
            Template::set_message(lang('sub_category_invalid_id'), 'error');
            redirect(SITE_AREA . '/settings/sub_category');
        }

        if (isset($_POST['save']))
        {
            $this->auth->restrict('Sub_Category.Settings.Edit');

            if ($this->save_sub_category('update', $id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message(lang('sub_category_edit_success'), 'success');
            } else
            {
                Template::set_message(lang('sub_category_edit_failure') . $this->sub_category_model->error, 'error');
            }
        } else if (isset($_POST['delete']))
        {
            $this->auth->restrict('Sub_Category.Settings.Delete');

            if ($this->sub_category_model->delete($id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message(lang('sub_category_delete_success'), 'success');

                redirect(SITE_AREA . '/settings/sub_category');
            } else
            {
                Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
            }
        }
        Template::set('cafe_list', $this->cafe_model->get_cafe_dropdown());
        Template::set('sub_category', $this->sub_category_model->find($id));
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_edit') . ' Sub Category');
        Template::render();
    }

    /*
      Method: create_attribute()

      Creates a Sub Category object.
     */

    public function create_attribute()
    {
        //$this->auth->restrict('Sub_Category.Settings.create_attribute');

        if ($this->input->post('save'))
        {
            $url_id = $this->input->post('sub_cat_id');
            //echo "<pre>";print_r($this->input->post());exit;
            if ($insert_id = $this->save_attributes())
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message('Attribute successfully created', 'success');
                Template::redirect(SITE_AREA . '/settings/sub_category/attribute_listing/' . $url_id);
            } else
            {
                Template::set_message(lang('sub_category_create_failure') . $this->sub_category_model->error, 'error');
            }
        }
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_create') . ' Attribute');
        Template::render();
    }

    /*
      Method: edit()

      Allows editing of Sub Category data.
     */

    public function edit_attribute()
    {
        $sub_cat_id = $this->uri->segment(5);
        $id = $this->uri->segment(6);

        if (empty($id))
        {
            Template::set_message(lang('sub_category_invalid_id'), 'error');
            redirect(SITE_AREA . '/settings/sub_category/attribute_listing/' . $sub_cat_id);
        }

        if (isset($_POST['save']))
        {
            $this->auth->restrict('Sub_Category.Settings.Edit');

            if ($this->save_attributes('update', $id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message('Attribute successfully updated', 'success');
            } else
            {
                Template::set_message(lang('sub_category_edit_failure') . $this->sub_category_model->error, 'error');
            }
        } else if (isset($_POST['delete']))
        {
            $this->auth->restrict('Sub_Category.Settings.Delete');

            if ($this->sub_category_model->delete_attribute($id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message(lang('sub_category_delete_success'), 'success');

                redirect(SITE_AREA . '/settings/sub_category');
            } else
            {
                Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
            }
        }

        Template::set('sub_category', $this->sub_category_model->get_attribute_details_by_id($id));
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_edit') . ' Attribute');
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_sub_category()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_sub_category($type = 'insert', $id = 0)
    {
        if ($type == 'update')
        {
            $_POST['id'] = $id;
        }


        $this->form_validation->set_rules('cat_id', 'Category', 'required|max_length[255]');
        $this->form_validation->set_rules('sub_category_name', 'Name', 'required|unique[bf_sub_category.sub_category_name,bf_sub_category.id]|trim|max_length[255]');
        $this->form_validation->set_rules('cafe_id', 'Cafe', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['cat_id'] = $this->input->post('cat_id');
        $data['sub_category_name'] = $this->input->post('sub_category_name');
        $data['cafe_id'] = $this->input->post('cafe_id');

        if ($type == 'insert')
        {
            $id = $this->sub_category_model->insert($data);

            if (is_numeric($id))
            {
                $return = $id;
            } else
            {
                $return = FALSE;
            }
        } else if ($type == 'update')
        {
            $return = $this->sub_category_model->update($id, $data);
        }

        return $return;
    }

    private function save_attributes($type = 'insert', $id = 0)
    {
        if ($type == 'update')
        {
            $_POST['id'] = $id;
            $this->form_validation->set_rules('attribute_name', 'Attribute', 'required|is_unique[bf_sub_category_attributes.attribute_name,bf_sub_category_attributes.sub_cat_id,bf_sub_category_attributes.id]|trim|max_length[255]');
        } else
        {
            $this->form_validation->set_rules('attribute_name', 'Attribute', 'required|is_unique[bf_sub_category_attributes.attribute_name,bf_sub_category_attributes.sub_cat_id]|trim|max_length[255]');
        }



        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['cafe_id'] = CAFE_ID;
        $data['sub_cat_id'] = $this->input->post('sub_cat_id');
        $data['attribute_name'] = $this->input->post('attribute_name');
        
        if ($type == 'insert')
        {
            $id = $this->sub_category_model->save_attributes($data);

            if (is_numeric($id))
            {
                $return = $id;
            } else
            {
                $return = FALSE;
            }
        } else if ($type == 'update')
        {
            $data['id'] = $id;
            $return = $this->sub_category_model->save_attributes($data);
        }

        return $return;
    }

    //--------------------------------------------------------------------



    private function save_option($type = 'insert', $id = 0)
    {
        if ($type == 'update')
        {
            $_POST['id'] = $id;
            $this->form_validation->set_rules('option_name', 'Option name', 'required|is_unique[bf_sub_category_attributes_options.option_name,bf_sub_category_attributes_options.sub_cat_attr_id,bf_sub_category_attributes_options.id]|trim|max_length[255]');
        } else
        {
            $this->form_validation->set_rules('option_name', 'Option name', 'required|is_unique[bf_sub_category_attributes_options.option_name,bf_sub_category_attributes_options.sub_cat_attr_id]|trim|max_length[255]');
        }



        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['cafe_id'] = CAFE_ID;
        $data['sub_cat_attr_id'] = $this->input->post('sub_cat_attr_id');
        $data['option_name'] = $this->input->post('option_name');

        if ($type == 'insert')
        {
            $id = $this->sub_category_model->save_option($data);

            if (is_numeric($id))
            {
                $return = $id;
            } else
            {
                $return = FALSE;
            }
        } else if ($type == 'update')
        {
            $data['id'] = $id;
            $return = $this->sub_category_model->save_option($data);
        }

        return $return;
    }

    /*
      Method: attribute_listing()

      Displays a list of form data.
     */
    public function option_listing($id = 0)
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
                    $result = $this->sub_category_model->delete_option($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_delete_success'), 'success');
                    redirect(SITE_AREA . '/settings/sub_category/option_listing/' . $id);
                } else
                {
                    Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
                }
            }
        }

        $records = $this->sub_category_model->get_option_by_attr_id($id);
        
        Template::set('records', $records);
        Template::set('toolbar_title', 'Attribute Options');
        Template::render();
    }

    /*
      Method: create_attribute()

      Creates a Sub Category object.
     */

    public function create_option()
    {
        if ($this->input->post('save'))
        {
            $url_id = $this->input->post('sub_cat_attr_id');
            //echo "<pre>";print_r($this->input->post());exit;
            if ($insert_id = $this->save_option())
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message('Option successfully created', 'success');
                Template::redirect(SITE_AREA . '/settings/sub_category/option_listing/' . $url_id);
            } else
            {
                Template::set_message(lang('sub_category_create_failure') . $this->sub_category_model->error, 'error');
            }
        }
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_create') . ' Option');
        Template::render();
    }
    
    /*
      Method: edit_option()

      Allows editing of Attribute's options.
     */

    public function edit_option()
    {
        $attr_id = $this->uri->segment(5);
        $id = $this->uri->segment(6);

        if (empty($id))
        {
            Template::set_message(lang('sub_category_invalid_id'), 'error');
            redirect(SITE_AREA . '/settings/sub_category/option_listing/' . $attr_id);
        }

        if (isset($_POST['save']))
        {
            $this->auth->restrict('Sub_Category.Settings.Edit');

            if ($this->save_option('update', $id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message('Option successfully updated', 'success');
            } else
            {
                Template::set_message(lang('sub_category_edit_failure') . $this->sub_category_model->error, 'error');
            }
        } else if (isset($_POST['delete']))
        {
            $this->auth->restrict('Sub_Category.Settings.Delete');

            if ($this->sub_category_model->delete_attribute($id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

                Template::set_message(lang('sub_category_delete_success'), 'success');

                redirect(SITE_AREA . '/settings/sub_category');
            } else
            {
                Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
            }
        }

        Template::set('sub_category', $this->sub_category_model->get_option_details_by_id($id));
        Assets::add_module_js('sub_category', 'sub_category.js');

        Template::set('toolbar_title', lang('sub_category_edit') . ' Option');
        Template::render();
    }

}