<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Admin_Controller
{


	/**
	 * Controller constructor sets the login restriction
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		$this->auth->restrict();
	}//end __construct()

	//--------------------------------------------------------------------


	/**
	 * Redirects the user to the Content context
	 *
	 * @return void
	 */
    public function index()
    {
        if (!class_exists('Role_model'))
        {
            $this->load->model('roles/role_model');
        }
        $user_role = $this->role_model->find((int)$this->current_user->role_id);
        $default_context = ($user_role !== false && isset($user_role->default_context)) ? $user_role->default_context : '';
        redirect(SITE_AREA .'/'.(isset($default_context) && !empty($default_context) ? $default_context : 'content'));
    }//end index()

	//--------------------------------------------------------------------


}//end class