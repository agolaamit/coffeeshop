<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Webservice extends REST_Controller {

    public function __construct() {
        parent::__construct();

        //if (!class_exists('User_model')) {
        $this->load->model('users/User_model', 'user_model', 'category/Category_model', 'category_model');
        //}
        $this->load->library('users/auth');
    }

    function login() {
        $json_array = ($this->_post_args['json']);        

        if (!$json_array['body']['email']) {
            echo json_encode(array('status' => 'error', 'message' => 'Please provide an email'));
            exit;
        }
        if (!$json_array['body']['password']) {
            echo json_encode(array('status' => 'error', 'message' => 'Please provide password'));
            exit;
        }
        if (!$json_array['body']['type']) {
            echo json_encode(array('status' => 'error', 'message' => 'Please provide type'));
            exit;
        }
        //print_r($this->post('email'));exit;
        if ($json_array['body']['type'] == 'email') {
            $password = $json_array['body']['password'];
            $selects = 'id, email, username, users.role_id, password_hash, users.role_id, users.deleted, users.active, nickname, phone, occupation, dob';
            $user = $this->user_model->select($selects)->find_by('email', $json_array['body']['email']);
            if ($user == FALSE) {
                echo json_encode(array('status' => 'error', 'message' => 'Email does not exist'));
                exit;
            }
            if ($user->deleted >= 1) { // in case we go to a unix timestamp later, this will still work.
                echo json_encode(array('status' => 'error', 'message' => 'User account deleted'));
                exit;
            }
            if ($user) {
                // Validate the password
                if (!function_exists('do_hash')) {
                    $this->ci->load->helper('security');
                }
                // Try password
                if ($password == $user->password_hash) {     
                    $this->load->model('users/users_app_login_model');
                    $data = array();
                    $data['user_id'] = $user->id;
                    $data['createdtime'] = time();
                    $data['session_id'] = do_hash(time(),'sha1');
                    
                    $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $user->id);
                    
                    if ($users_app_login == FALSE) {
                        $this->users_app_login_model->insert($data);
                    }
                    else{
                        $this->users_app_login_model->update($users_app_login->id, $data);
                    }
                    
                    $user_detail->user_id = $user->id;
                    $user_detail->email = $user->email;
                    $user_detail->nickname = $user->nickname;
                    $user_detail->phone = $user->phone;
                    $user_detail->username = $user->username;
                    $user_detail->session_id = $data['session_id'];
                    $user_detail->dob = $user->dob;
                    
                    echo json_encode(array('status' => 'success', 'message' => $user_detail)); // 200 being the HTTP response code
                    exit;
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Invaid Password'));
                    exit;
                }
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Email does not exist'));
                //return $this->response(array('status'=>'error', 'message' => 'Email does not exist'), 404);
                exit;
            }
        }
    }

    //To delete order me user account.
    function delete_account() {
        $json_array = ($this->_post_args['json']);
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            
            $user = $this->user_model->find($json_array['body']['user_id']);
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                if ($this->user_model->delete($json_array['body']['user_id']))
                {
                    echo json_encode(array('status' => 'success', 'message' => "The User was successfully deleted"));
                    exit;
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => 'User does not deleted'));              
                    exit;
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }

    //To sign up new user.
    function create_account() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->CI = & $this;
        $this->load->model('users/user_model');
        
        $json_array = ($this->_post_args['json']);
        $_POST = $this->post = $json_array['body'];
        
        $role_id = "4";
        $cafe_id = "4";
        $this->form_validation->set_error_delimiters('','');
        
        $this->form_validation->set_rules('email', "bf_email", 'required|trim|unique[users.email]|valid_email|max_length[120]|xss_clean');
        $this->form_validation->set_rules('password', lang('bf_password'), 'required|trim|strip_tags|min_length[6]|max_length[120]|valid_password|xss_clean');
        //$this->form_validation->set_rules('username', lang('bf_username'), 'required|trim|strip_tags|max_length[30]|unique[users.username]|xss_clean');
        $this->form_validation->set_rules('nickname', lang('bf_nickname'), 'required|trim|strip_tags|max_length[255]|xss_clean');
        
        if ($this->form_validation->run($this) === FALSE)
        {
            $email = $this->form_validation->error('email') ? $this->form_validation->error('email') : "true";
            //$username = $this->form_validation->error('username') ? $this->form_validation->error('username') : "true";
            $password = $this->form_validation->error('password') ? $this->form_validation->error('password') : "true";
            $nickname = $this->form_validation->error('nickname') ? $this->form_validation->error('nickname') : "true";
            
            //'message' => 'We don\'t have data to display, Minimum information required to process the request is missing
            $response = array(
                'status' => 'error',
                'message' => 'Incomplete form',
                'email' => $email,
                //'username' => $username,
                'nickname'=> $nickname,
                'password' => $password
            );

            $this->response($response, 200);
        }
        else
        {
            $data = array();
            
            $data['username'] = $this->input->post('username');
            $data['nickname'] = $this->input->post('nickname');
            $data['phone'] = $this->input->post('phone');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['active'] = 1;
            $data['cafe_id'] = 4;
            $this->user_model->insert($data);
            
            echo json_encode(array('status' => 'success', 'message' => "User successfully created"));
            exit;
        }
        
    }

    //To edit existing account preferences
    function edit_account() {
        $json_array = ($this->_post_args['json']);
        
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            
            $password_update = 0;
            //$user = $this->user_model->find($json_array['body']['user_id']);
            $selects = 'id, email, users.role_id, password_hash, users.role_id, users.deleted, users.active';
            $user = $this->user_model->select($selects)->find_by('id', $json_array['body']['user_id']);
            if (isset($user) && isset($user->deleted) && $user->deleted >= 1) { 
                echo json_encode(array('status' => 'error', 'message' => 'User account deleted'));
                exit;
            }
            if (isset($json_array['body']['current_password']) && $json_array['body']['current_password'] != "")
            {                
                if (!isset($json_array['body']['password']) || $json_array['body']['password'] == "")
                {
                   echo json_encode(array('status' => 'error', 'message' => 'Password field should not be empty'));
                   exit; 
                }
            }
            if (isset($json_array['body']['password']) && $json_array['body']['password'] != "")
            {
                if (!isset($json_array['body']['current_password']) || $json_array['body']['current_password'] == "")
                {
                   echo json_encode(array('status' => 'error', 'message' => 'Current Password field should not be empty'));
                   exit; 
                }
            }
            if (isset($json_array['body']['current_password']) && $json_array['body']['current_password'] != "" && isset($json_array['body']['password']) && $json_array['body']['password'] != "") {
                $password_update = 1;
                if ($json_array['body']['current_password'] != $user->password_hash) 
                {
                    echo json_encode(array('status' => 'error', 'message' => 'Current password does not match'));
                    exit;
                }
            }
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                $id = $user->id;
                // Update
                $this->load->helper('form');
                $this->load->library('form_validation');
                $this->form_validation->CI = & $this;
                $this->load->model('users/user_model');

                $_POST = $this->post = $json_array['body'];

                $role_id = "4";
                $cafe_id = "4";
                $this->form_validation->set_error_delimiters('','');

                $_POST['id'] = $id;
                $this->form_validation->set_rules('email', lang('bf_email'), 'required|trim|unique[users.email,users.id]|valid_email|max_length[120]|xss_clean');
                $this->form_validation->set_rules('password', lang('bf_password'), 'trim|strip_tags|min_length[6]|max_length[120]|valid_password|xss_clean');
                $extra_unique_rule = ',users.id';
                //$this->form_validation->set_rules('username', lang('bf_username'), 'required|trim|strip_tags|max_length[30]|unique[users.username' . $extra_unique_rule . ']|xss_clean');
                
                $this->form_validation->set_rules('nickname', lang('bf_nickname'), 'required|trim|strip_tags|max_length[255]|xss_clean');
                if ($this->form_validation->run($this) === FALSE)
                {
                    $email = $this->form_validation->error('email') ? $this->form_validation->error('email') : "true";
                    //$username = $this->form_validation->error('username') ? $this->form_validation->error('username') : "true";
                    if($password_update == '1')
                    {                        
                        $password = $this->form_validation->error('password') ? $this->form_validation->error('password') : "true";
                    }
                    $nickname = $this->form_validation->error('nickname') ? $this->form_validation->error('nickname') : "true";

                    //'message' => 'We don\'t have data to display, Minimum information required to process the request is missing
                    $response = array(
                        'status' => 'error',
                        'message' => 'Incomplete form',
                        'email' => $email,
                        //'username' => $username,
                        'nickname'=> $nickname,
                        'password' => $password
                    );

                    $this->response($response, 200);
                }
                else
                {
                    $data = array();

                    $data['username'] = $this->input->post('username');
                    $data['nickname'] = $this->input->post('nickname');
                    $data['phone'] = $this->input->post('phone');
                    $data['email'] = $this->input->post('email');
                    if($this->input->post('password') != "")
                    {
                        $data['password'] = $this->input->post('password');
                    }
                    $data['dob'] = $this->input->post('dob');
                    $data['active'] = 1;
                    $data['cafe_id'] = 4;
                    
                    $this->user_model->update($id, $data);
                    
                    echo json_encode(array('status' => 'success', 'message' => "User successfully updated"));
                    exit;
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }

    //To get current user information
    function profile() {        
        $json_array = ($this->_post_args['json']);        
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            //$user = $this->user_model->find($json_array['body']['user_id']);
            $selects = 'id, email, nickname, phone, username, dob';
            $user = $this->user_model->select($selects)->find_by('id', $json_array['body']['user_id']);
            if (isset($user) && isset($user->deleted) && $user->deleted >= 1) { 
                echo json_encode(array('status' => 'error', 'message' => 'User account deleted'));
                exit;
            }
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                $user_detail->user_id = $user->id;
                $user_detail->email = $user->email;
                $user_detail->nickname = $user->nickname;
                $user_detail->phone = $user->phone;
                $user_detail->username = $user->username;                    
                $user_detail->dob = $user->dob;
                echo json_encode(array('status' => 'success', 'message' => $user_detail));
                exit;
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }

    //To get all items list along with attributes of all items
    function item_list() {
        $json_array = ($this->_post_args['json']);
        
        $items = array();
        $this->load->model('category/category_model');
        $this->load->model('sub_category/sub_category_model');
        $this->load->model('sub_category/sub_category_attributes_model');
        $this->load->model('sub_category/sub_category_attributes_options_model');
        
        $this->load->model('product/product_model');
        $this->load->model('product/product_attributes_model');
        
        $category_list = $this->category_model->find_all();
        $j=0;
        foreach($category_list as $category_data)
        {
            $sub_category_list = $this->sub_category_model->find_all_by('cat_id', $category_data->id);
            $subsections = array(); 
            if(is_array($sub_category_list) > 0)
            {
                $k=0;
                foreach($sub_category_list as $sub_category_data)
                {
                    $product_list = $this->product_model->find_all_by(array('cat_id'=>$category_data->id, 'sub_cat_id'=>$sub_category_data->id));
                    
                    //$sub_category_attr_list = 
                    
                    $products = array();
                    if(is_array($product_list) > 0)
                    {
                        $l=0;
                        foreach($product_list as $product_data)
                        {
                            $feature_list = $this->sub_category_attributes_model->find_all_by(array('sub_cat_id'=>$sub_category_data->id));
                            $features = array();
                            if(is_array($feature_list) > 0)
                            {
                                $m=0;
                                foreach($feature_list as $feature_data)
                                {
                                    $value_list = $this->sub_category_attributes_options_model->find_all_by(array('sub_cat_attr_id'=>$feature_data->id));
                                    $values = array();
                                    if(is_array($value_list) > 0)
                                    {
                                        $n=0;
                                        foreach($value_list as $value_data)
                                        {
                                            
                                            $value_price = $this->product_attributes_model->select('extra_price')->find_by(array('sub_cat_attr_option_id'=>$value_data->id, 'product_id'=>$product_data->id));
                                            
                                            $values[$n]['name'] = $value_data->option_name;
                                            if(isset($value_price->extra_price) && $value_price->extra_price != '')
                                                $values[$n]['cost'] = $value_price->extra_price;
                                            else
                                                $values[$n]['cost'] = "0.0";
                                            $n++;
                                        }
                                    }
                                    
                                    $features[$m]['name'] = $feature_data->attribute_name;
                                    $features[$m]['values'] = $values;
                                    $m++;
                                }
                            }
                            $products[$l]['name'] = $product_data->product_name;
                            $products[$l]['price'] = $product_data->price;
                            $products[$l]['features'] = $features;                            
                            $l++;
                        }
                    }                    
                    $subsections[$k]['name'] = $sub_category_data->sub_category_name;
                    $subsections[$k]['items'] = $products;
                    $k++;
                }
            }
            $items[$j]['sections']['name'] = $category_data->category_name;
            $items[$j]['sections']['subsections'] = $subsections;
            $j++;
        }
        
        echo json_encode(array('status' => 'success', 'message' => $items));
        exit;
    }
    
    function order() 
    { 
        $json_array = ($this->_post_args['json']); 
        $this->load->model('order/order_model');
        $_POST = $this->post = $json_array['body'];
        
        if ($json_array['body']['user_id'] != "") 
        {    
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            
            $user = $this->user_model->find($json_array['body']['user_id']);
            
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id ) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                $data = array();
                $data['user_id'] = $this->input->post('user_id');
                $data['name'] = $this->input->post('name');
                $data['items'] = serialize($this->input->post('items'));
                $data['total'] = $this->input->post('total');
                $data['createdtime'] = $this->input->post('createdtime');
                $data['pickuptime'] = $this->input->post('pickuptime');

                $order_id = $this->order_model->insert($data);
                
                echo json_encode(array('status' => 'success', 'message' => "Order successfully created", 'order_id'=>$order_id,'pickuptime'=>$data['pickuptime']));
                exit; 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
        
    }
    
    function favorite() 
    { 
        $json_array = ($this->_post_args['json']);
        $this->load->model('order/order_model');
        $this->load->model('order/order_favourite_model');
        
        if ($json_array['body']['user_id'] != "") 
        {   
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            
            $user = $this->user_model->find($json_array['body']['user_id']);
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                $fav_order = $this->order_favourite_model->find_all_by(array('user_id'=>$json_array['body']['user_id']));
                
                if($fav_order == false)
                {
                    $fav_order = "There is no favourite order for you";
                    echo json_encode(array('status' => 'error', 'message' => $fav_order));
                }
                else
                {      
                    echo json_encode(array('status' => 'success', 'message' => $fav_order));
                }
                
                
    exit;
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }
    
    function order_detail() 
    { 
        $json_array = ($this->_post_args['json']);        
        $this->load->model('order/order_model');
        $this->load->model('order/order_favourite_model');
        $_POST = $this->post = $json_array['body'];
        $oder = $this->order_model->find($json_array['body']['order_id']);
        if ($json_array['body']['user_id'] != "") 
        {
        // Validate session code start
        if($json_array['body']['session_id'] == "")
        {
            echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
            exit;
        }
        $this->load->model('users/users_app_login_model');
        $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
        $allowed_time = time()-1800;        
        if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
        }
        else 
        {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
            exit;
        }
        // Validate session code end
        }
        else
        {
            echo json_encode(array('status' => 'error', 'message' => 'User ID is required'));
            exit;
        }
        if (isset($oder) && isset($oder->id) && $oder->id != '')
        {
            $orders = $this->order_model->find_by('id',$json_array['body']['order_id']);
            
            $orders->order_id = $orders->id;
            unset($orders->id);
            if($orders->items != '')
            {
                $orders->items = $this->mb_unserialize($orders->items);
            }
            if($orders->items == false)
            {
               echo json_encode(array('status' => 'error', 'message' => 'There is some problem with this order'));                
               exit; 
            }
            //print_r($orders); exit;
            echo json_encode(array('status' => 'success', 'message' => $orders));
            exit;
        }
        else 
        {
            echo json_encode(array('status' => 'error', 'message' => 'Order does not exist'));                
            exit;
        }
    }
    
    function mb_unserialize($serial_str) { 
        $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str ); 
        return unserialize($out); 
    }
    
    function mark_favorite() 
    { 
        $json_array = ($this->_post_args['json']);        
        $this->load->model('order/order_model');
        $this->load->model('order/order_favourite_model');
        $_POST = $this->post = $json_array['body'];
        
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            $user = $this->user_model->find($json_array['body']['user_id']);
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                $oder = $this->order_model->find($json_array['body']['order_id']);
                if (isset($oder) && isset($oder->id) && $oder->id != '')
                {
                    $data = array();
                    $data['user_id'] = $this->input->post('user_id');
                    $data['order_id'] = $this->input->post('order_id');
                    $data['order_title'] = $this->input->post('order_title');

                    $this->order_favourite_model->insert($data);

                    echo json_encode(array('status' => 'success', 'message' => "Order successfully added to favourite list"));
                    exit;
                }
                else 
                {
                    echo json_encode(array('status' => 'error', 'message' => 'Order does not exist'));                
                    exit;
                }
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }
    
    function delete_favourite() {
        $json_array = ($this->_post_args['json']);
        $this->load->model('order/order_favourite_model');
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            // Validate session code end
            $user = $this->user_model->find($json_array['body']['user_id']);
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                if ($this->order_favourite_model->delete_where(array("user_id"=>$json_array['body']['user_id'],"order_id"=>$json_array['body']['order_id'])))
                {
                    echo json_encode(array('status' => 'success', 'message' => "The order was successfully deleted from favourite list"));
                    exit;
                }
                else {
                    echo json_encode(array('status' => 'error', 'message' => 'User does not deleted'));              
                    exit;
                }
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }
    
    function facebook_login(){
        $json_array = ($this->_post_args['json']);
        if ($json_array['body']['access_token'] != "") 
        {
            
            //$access_token = "CAAIfdQNKtUcBAJu0ZClmSLZACkHSLvcZAT3pZBa0Qq5eEfZB6fnZBIy3jYV1AWRF3pt9NfHWBZB8vunszHEJd3r9pLMTTvqhZCwJph5BxQPAfi7sXcecnxtFcBTtMhacZCLOWQzfOIK9w7AdBdiZADZB74dnRpR0dKUBZAVYyHSK62nDqoC0gZCFBKIPbHZCFeh569bKAZD";
            $access_token = $json_array['body']['access_token'];
            
            $url = 'https://graph.facebook.com/me?access_token=';
            $url_full = $url.$access_token;
            $json_op = file_get_contents($url_full);
            
            $arr = json_decode($json_op);
            
            if($arr->id != '')
            {
                
                $selects = 'id, email, nickname, phone, username, dob';
                $user = $this->user_model->select($selects)->find_by('facebook_id', $arr->id);
                if (isset($user) && isset($user->id) && $user->id != '')
                {
                    
                }
                else
                {
                    
                    $data = array();
            
                    $data['facebook_id'] = $arr->id;
                    $data['username'] = $arr->name;                    
                    $data['nickname'] = $arr->first_name;
                    $data['phone'] = $arr->phone;
                    $data['email'] = $arr->email;
                    
                    $data['active'] = 1;
                    $data['cafe_id'] = 4;
                    $data['role_id'] = 4;
                    
                    $user_id = $this->user_model->insert_fb($data);
                    
                    $selects = 'id, email, nickname, phone, username, dob';
                    $user = $this->user_model->select($selects)->find_by('id', $user_id);
                }
                
                $data = array();
                $data['user_id'] = $user->id;
                $data['createdtime'] = time();
                $data['session_id'] = do_hash(time(),'sha1');
                $this->load->model('users/users_app_login_model');
                $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $user->id);
                
                if ($users_app_login == FALSE) {
                    $this->users_app_login_model->insert($data);
                }
                else{
                    $this->users_app_login_model->update($users_app_login->id, $data);
                }

                $user_detail->user_id = $user->id;
                $user_detail->email = $user->email;
                $user_detail->nickname = $user->nickname;
                $user_detail->phone = $user->phone;
                $user_detail->username = $user->username;
                $user_detail->session_id = $data['session_id'];
                $user_detail->dob = $user->dob;

                echo json_encode(array('status' => 'success', 'message' => $user_detail)); // 200 being the HTTP response code
                exit;
            }
            else
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid access token'));                
            exit;
            }
            
        }
        else {
            echo json_encode(array('status' => 'error', 'message' => 'Access token required'));                
            exit;
        }

        // Try Codeigniter Facebook Library
//        try {
//            $user = $this->facebook->api('/me?access_token='.$access_token);
//        } catch (Exception $e) {
//            print_r($e);
//        }
//
//        // Codeigniter CURL Library
//        $this->load->library('curl');  
//        //echo $this->curl->simple_get($url_full);
//        $info =  $this->curl->info;
        //print_r($info);

    }
    
    function logout() {
        $json_array = ($this->_post_args['json']);        
        if ($json_array['body']['user_id'] != "") 
        {
            // Validate session code start
            if($json_array['body']['session_id'] == "")
            {
                echo json_encode(array('status' => 'error', 'message' => 'User session not available'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $users_app_login = $this->users_app_login_model->select('*')->find_by('user_id', $json_array['body']['user_id']);            
            $allowed_time = time()-1800;
            if ($json_array['body']['session_id'] == $users_app_login->session_id) {                 
            }
            else 
            {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid Session'));
                exit;
            }
            $this->load->model('users/users_app_login_model');
            $this->users_app_login_model->delete_where(array("user_id"=>$json_array['body']['user_id']));
            echo json_encode(array('status' => 'success', 'message' => "User has successfully logged out from the server"));
            exit;
        }        
        // Validate session code end
    }
   
}