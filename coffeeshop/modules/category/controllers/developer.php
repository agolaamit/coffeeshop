<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class developer extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Category.Developer.View');
		$this->load->model('category_model', null, true);
		$this->lang->load('category');
		
		Template::set_block('sub_nav', 'developer/_sub_nav');
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
					$result = $this->category_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('category_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('category_delete_failure') . $this->category_model->error, 'error');
				}
			}
		}

		$records = $this->category_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Category');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a Category object.
	*/
	public function create()
	{
		$this->auth->restrict('Category.Developer.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_category())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('category_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_create_success'), 'success');
				Template::redirect(SITE_AREA .'/developer/category');
			}
			else
			{
				Template::set_message(lang('category_create_failure') . $this->category_model->error, 'error');
			}
		}
		Assets::add_module_js('category', 'category.js');

		Template::set('toolbar_title', lang('category_create') . ' Category');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of Category data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('category_invalid_id'), 'error');
			redirect(SITE_AREA .'/developer/category');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Category.Developer.Edit');

			if ($this->save_category('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('category_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('category_edit_failure') . $this->category_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Category.Developer.Delete');

			if ($this->category_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('category_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'category');

				Template::set_message(lang('category_delete_success'), 'success');

				redirect(SITE_AREA .'/developer/category');
			} else
			{
				Template::set_message(lang('category_delete_failure') . $this->category_model->error, 'error');
			}
		}
		Template::set('category', $this->category_model->find($id));
		Assets::add_module_js('category', 'category.js');

		Template::set('toolbar_title', lang('category_edit') . ' Category');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_category()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_category($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('category_name','Name','required|unique[bf_category.category_name,bf_category.id]|trim|max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['category_name']        = $this->input->post('category_name');

		if ($type == 'insert')
		{
			$id = $this->category_model->insert($data);

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
			$return = $this->category_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}