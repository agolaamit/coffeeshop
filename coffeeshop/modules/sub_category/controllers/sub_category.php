<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sub_category extends Front_Controller {

	//--------------------------------------------------------------------


	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('sub_category_model', null, true);
		$this->lang->load('sub_category');
		
	}

	//--------------------------------------------------------------------



	/*
		Method: index()

		Displays a list of form data.
	*/
	public function index()
	{

		$records = $this->sub_category_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------




}