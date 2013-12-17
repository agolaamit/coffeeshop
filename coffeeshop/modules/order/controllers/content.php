<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict('Order.Content.View');
		$this->load->model('order_model', null, true);
		$this->lang->load('order');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
			Assets::add_css('jquery-ui-timepicker.css');
			Assets::add_js('jquery-ui-timepicker-addon.js');
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
					$result = $this->order_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('order_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('order_delete_failure') . $this->order_model->error, 'error');
				}
			}
		}

		$records = $this->order_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage order');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: create()

		Creates a order object.
	*/
	public function create()
	{
		$this->auth->restrict('Order.Content.Create');

		if ($this->input->post('save'))
		{
			if ($insert_id = $this->save_order())
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('order_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'order');

				Template::set_message(lang('order_create_success'), 'success');
				Template::redirect(SITE_AREA .'/content/order');
			}
			else
			{
				Template::set_message(lang('order_create_failure') . $this->order_model->error, 'error');
			}
		}
		Assets::add_module_js('order', 'order.js');

		Template::set('toolbar_title', lang('order_create') . ' order');
		Template::render();
	}

	//--------------------------------------------------------------------



	/*
		Method: edit()

		Allows editing of order data.
	*/
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('order_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/order');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Order.Content.Edit');

			if ($this->save_order('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('order_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');

				Template::set_message(lang('order_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('order_edit_failure') . $this->order_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Order.Content.Delete');

			if ($this->order_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->current_user->id, lang('order_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'order');

				Template::set_message(lang('order_delete_success'), 'success');

				redirect(SITE_AREA .'/content/order');
			} else
			{
				Template::set_message(lang('order_delete_failure') . $this->order_model->error, 'error');
			}
		}
		Template::set('order', $this->order_model->find($id));
		Assets::add_module_js('order', 'order.js');

		Template::set('toolbar_title', lang('order_edit') . ' order');
		Template::render();
	}

	//--------------------------------------------------------------------


	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/*
		Method: save_order()

		Does the actual validation and saving of form data.

		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.

		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_order($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['id'] = $id;
		}

		
		$this->form_validation->set_rules('order_userid','Userid','required|max_length[11]');
		$this->form_validation->set_rules('order_name','Name','max_length[255]');
		$this->form_validation->set_rules('order_items','Items','');
		$this->form_validation->set_rules('order_total','Total','max_length[11]');
		$this->form_validation->set_rules('order_createdtime','Created Time','');
		$this->form_validation->set_rules('order_pickuptime','Pickup Time','');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['order_userid']        = $this->input->post('order_userid');
		$data['order_name']        = $this->input->post('order_name');
		$data['order_items']        = $this->input->post('order_items');
		$data['order_total']        = $this->input->post('order_total');
		$data['order_createdtime']        = $this->input->post('order_createdtime') ? $this->input->post('order_createdtime') : '0000-00-00 00:00:00';
		$data['order_pickuptime']        = $this->input->post('order_pickuptime') ? $this->input->post('order_pickuptime') : '0000-00-00 00:00:00';

		if ($type == 'insert')
		{
			$id = $this->order_model->insert($data);

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
			$return = $this->order_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------



}