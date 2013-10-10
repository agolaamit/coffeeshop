<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends Admin_Controller
{


	/**
	 * Controller constructor sets the Title and Permissions
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		Template::set('toolbar_title', 'Reports');

		$this->auth->restrict('Site.Reports.View');
	}//end __construct()

	//--------------------------------------------------------------------

	/**
	 * Displays the Reports context homepage
	 *
	 * @return void
	 */
	public function index()
	{
		Template::set_view('admin/reports/index');
		Template::render();
	}//end index()

	//--------------------------------------------------------------------


}//end class