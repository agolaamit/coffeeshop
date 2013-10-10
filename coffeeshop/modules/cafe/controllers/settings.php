<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class settings extends Admin_Controller
{

    //--------------------------------------------------------------------


    public function __construct()
    {
        parent::__construct();

        $this->auth->restrict('Cafe.Settings.View');
        $this->load->model('cafe_model', null, true);
        $this->lang->load('cafe');

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
                    $result = $this->cafe_model->delete($pid);
                }

                if ($result)
                {
                    Template::set_message(count($checked) . ' ' . lang('cafe_delete_success'), 'success');
                }
                else
                {
                    Template::set_message(lang('cafe_delete_failure') . $this->cafe_model->error, 'error');
                }
            }
        }

        $records = $this->cafe_model->find_all();

        Template::set('records', $records);
        Template::set('toolbar_title', 'Manage Cafe');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: create()

      Creates a Cafe object.
     */
    public function create()
    {
        $this->auth->restrict('Cafe.Settings.Create');

        if ($this->input->post('save'))
        {
            if ($insert_id = $this->save_cafe())
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('cafe_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'cafe');

                Template::set_message(lang('cafe_create_success'), 'success');
                Template::redirect(SITE_AREA . '/settings/cafe');
            }
            else
            {
                Template::set_message(lang('cafe_create_failure') . $this->cafe_model->error, 'error');
            }
        }
        Assets::add_module_js('cafe', 'cafe.js');

        Template::set('toolbar_title', lang('cafe_create') . ' Cafe');
        Template::render();
    }

    //--------------------------------------------------------------------



    /*
      Method: edit()

      Allows editing of Cafe data.
     */
    public function edit()
    {
        $id = $this->uri->segment(5);

        if (empty($id))
        {
            Template::set_message(lang('cafe_invalid_id'), 'error');
            redirect(SITE_AREA . '/settings/cafe');
        }

        if (isset($_POST['save']))
        {
            $this->auth->restrict('Cafe.Settings.Edit');

            if ($this->save_cafe('update', $id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('cafe_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cafe');

                Template::set_message(lang('cafe_edit_success'), 'success');
            }
            else
            {
                Template::set_message(lang('cafe_edit_failure') . $this->cafe_model->error, 'error');
            }
        }
        else if (isset($_POST['delete']))
        {
            $this->auth->restrict('Cafe.Settings.Delete');

            if ($this->cafe_model->delete($id))
            {
                // Log the activity
                $this->activity_model->log_activity($this->current_user->id, lang('cafe_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cafe');

                Template::set_message(lang('cafe_delete_success'), 'success');

                redirect(SITE_AREA . '/settings/cafe');
            }
            else
            {
                Template::set_message(lang('cafe_delete_failure') . $this->cafe_model->error, 'error');
            }
        }
        Template::set('cafe', $this->cafe_model->find($id));
        Assets::add_module_js('cafe', 'cafe.js');

        Template::set('toolbar_title', lang('cafe_edit') . ' Cafe');
        Template::render();
    }

    //--------------------------------------------------------------------
    //--------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------

    /*
      Method: save_cafe()

      Does the actual validation and saving of form data.

      Parameters:
      $type	- Either "insert" or "update"
      $id		- The ID of the record to update. Not needed for inserts.

      Returns:
      An INT id for successful inserts. If updating, returns TRUE on success.
      Otherwise, returns FALSE.
     */
    private function save_cafe($type = 'insert', $id = 0)
    {
        if ($type == 'update')
        {
            $_POST['id'] = $id;
        }


        $this->form_validation->set_rules('cafe_name', 'Name', 'required|unique[bf_cafe.cafe_name,bf_cafe.id]|max_length[255]');
        $this->form_validation->set_rules('cafe_url_name', 'Url Name', 'required|unique[bf_cafe.cafe_url_name,bf_cafe.id]|alpha|max_length[255]');
        $this->form_validation->set_rules('cafe_status', 'Status', 'required|max_length[255]');

        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }

        // make sure we only pass in the fields we want

        $data = array();
        $data['cafe_name'] = $this->input->post('cafe_name');
        $data['cafe_url_name'] = $this->input->post('cafe_url_name');
        $data['cafe_status'] = $this->input->post('cafe_status');

        if ($type == 'insert')
        {
            $id = $this->cafe_model->insert($data);

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
            $return = $this->cafe_model->update($id, $data);
        }

        return $return;
    }

    //--------------------------------------------------------------------
}