<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Sub_Category.Content.View');
		$this->load->model('sub_category_model', null, true);
		$this->lang->load('sub_category');

		Template::set_block('sub_nav', 'content/_sub_nav');
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
					$result = $this->sub_category_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('sub_category_delete_success'), 'success');
				}
				else
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

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Sub Category object.
	*/
	public function create()
	{
		$this->auth->restrict('Sub_Category.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_sub_category())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category');

				Template::set_message(lang('sub_category_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/sub_category');
			}
			else
			{
				Template::set_message(lang('sub_category_create_failure') . $this->sub_category_model->error, 'error');
			}
		}
		Assets::add_module_js('sub_category', 'sub_category.js');
                                                                
		Template::set('toolbar_title', lang('sub_category_create') . ' Sub Category');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Sub Category data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('sub_category_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/sub_category');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Sub_Category.Content.Edit');

			if ($this->save_sub_category('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

				Template::set_message(lang('sub_category_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('sub_category_edit_failure') . $this->sub_category_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Sub_Category.Content.Delete');

			if ($this->sub_category_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('sub_category_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');

				Template::set_message(lang('sub_category_delete_success'), 'success');

				redirect(SITE_AREA .'/content/sub_category');
			} else
			{
				Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
			}
		}
		Template::set('sub_category', $this->sub_category_model->find($id));
		Assets::add_module_js('sub_category', 'sub_category.js');

		Template::set('toolbar_title', lang('sub_category_edit') . ' Sub Category');
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
	private function save_sub_category($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('sub_category_category','Category','required|max_length[255]');
		$this->form_validation->set_rules('sub_category_name','Name','required|unique[bf_sub_category.sub_category_name,bf_sub_category.id]|trim|max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['sub_category_category']        = $this->input->post('sub_category_category');
		$data['sub_category_name']        = $this->input->post('sub_category_name');

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
		}
		else if ($type == 'update')
		{
			$return = $this->sub_category_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}