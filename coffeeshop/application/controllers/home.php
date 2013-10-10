<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Front_Controller
{


	/**
	 * Displays the homepage of the Coffeeshop app
	 *
	 * @return void
	 */
	public function index()
	{
		Template::render();
	}//end index()

	//--------------------------------------------------------------------


}//end class