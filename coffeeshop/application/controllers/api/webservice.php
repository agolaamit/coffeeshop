<?php

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

    function login_get() {
        
    }

    function login_post() {
        /* $json_array=json_decode($this->_post_args['json']);

          if (!$json_array->body->email) {
          echo json_encode(array('status'=>'error', 'message' => 'Please provide an email'));
          exit;
          }
          if (!$json_array->body->password) {
          echo json_encode(array('status'=>'error', 'message' => 'Please provide password'));
          exit;
          }
          if (!$json_array->body->type) {
          echo json_encode(array('status'=>'error', 'message' => 'Please provide type'));
          exit;
          }
          //print_r($this->post('email'));exit;
          if ($json_array->body->type == 'email') {
          $password = $json_array->body->password;
          $selects = 'id, email, username, users.role_id, salt, password_hash, users.role_id, users.deleted, users.active';
          $user = $this->user_model->select($selects)->find_by('email', $json_array->body->email);
          if ($user == FALSE) {
          echo json_encode(array('status'=>'error', 'message' => 'Email does not exist'));
          exit;
          }
          if ($user->deleted >= 1) { // in case we go to a unix timestamp later, this will still work.
          echo json_encode(array('status'=>'error', 'message' => 'User account deleted'));
          exit;
          }
          if ($user) {
          // Validate the password
          if (!function_exists('do_hash')) {
          $this->ci->load->helper('security');
          }
          // Try password
          if (do_hash($user->salt . $password) == $user->password_hash) {
          echo json_encode(array('status'=>'success', 'message' =>$user)); // 200 being the HTTP response code
          exit;
          } else {
          echo json_encode(array('status'=>'error', 'message' => 'Invaid Password'));
          exit;
          }
          } else {
          echo json_encode(array('status'=>'error', 'message' => 'Email does not exist'));
          //return $this->response(array('status'=>'error', 'message' => 'Email does not exist'), 404);
          exit;
          }
          }
         * 
         */
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
            $selects = 'id, email, username, users.role_id, salt, password_hash, users.role_id, users.deleted, users.active, nickname, phone, occupation, dob';
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
                if (do_hash($user->salt . $password) == $user->password_hash) {
                    $user_detail->id = $user->id;
                    $user_detail->email = $user->email;
                    $user_detail->nickname = $user->nickname;
                    $user_detail->phone = $user->phone;
                    $user_detail->occupation = $user->occupation;
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
    function deleteAccount() {
        $json_array = ($this->_post_args['json']);
        if ($json_array['body']['userId'] != "") 
        {
            $user = $this->user_model->find($json_array['body']['userId']);
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                if ($this->user_model->delete($json_array['body']['userId']))
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
    function createAccount() {
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
            
            //$data['username'] = $this->input->post('username');
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
    function editAccount() {
        $json_array = ($this->_post_args['json']);
        if ($json_array['body']['userId'] != "") 
        {
            //$user = $this->user_model->find($json_array['body']['userId']);
            $selects = 'id, email, users.role_id, salt, password_hash, users.role_id, users.deleted, users.active';
            $user = $this->user_model->select($selects)->find_by('id', $json_array['body']['userId']);
            if (isset($user) && isset($user->deleted) && $user->deleted >= 1) { 
                echo json_encode(array('status' => 'error', 'message' => 'User account deleted'));
                exit;
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

                    //$data['username'] = $this->input->post('username');
                    $data['nickname'] = $this->input->post('nickname');
                    $data['phone'] = $this->input->post('phone');
                    $data['email'] = $this->input->post('email');
                    $data['password'] = $this->input->post('password');
                    $data['occupation'] = $this->input->post('occupation');
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
        if ($json_array['body']['userId'] != "") 
        {
            //$user = $this->user_model->find($json_array['body']['userId']);
            $selects = 'id, email, nickname, phone, occupation, dob';
            $user = $this->user_model->select($selects)->find_by('id', $json_array['body']['userId']);
            if (isset($user) && isset($user->deleted) && $user->deleted >= 1) { 
                echo json_encode(array('status' => 'error', 'message' => 'User account deleted'));
                exit;
            }
            if (isset($user) && isset($user->id) && $user->id != '')
            {
                echo json_encode(array('status' => 'success', 'message' => $user));
                exit;
            }
            else {
                echo json_encode(array('status' => 'error', 'message' => 'User does not exist'));                
                exit;
            }
        }
    }

    //To get all items list along with attributes of all items
    function itemList() {
        $json_array = ($this->_post_args['json']);
        
        $items = array();
        $this->load->model('category/category_model');
        $this->load->model('sub_category/sub_category_model');
        $this->load->model('product/product_model');
        
        $category_list = $this->category_model->find_all();
        foreach($category_list as $category_data)
        {
            $sub_category_list = $this->sub_category_model->find_all_by('cat_id', $category_data->id);
            $subsections = array(); 
            if(is_array($sub_category_list) > 0)
            {
                foreach($sub_category_list as $sub_category_data)
                {
                    $product_list = $this->product_model->find_all_by(array('cat_id'=>$category_data->id, 'sub_cat_id'=>$sub_category_data->id));
                    
                    $sub_category_attr_list = 
                    
                    $products = array();
                    if(is_array($product_list) > 0)
                    {
                        foreach($product_list as $product_data)
                        {
                            $products[]['name'] = $product_data->product_name;
                            $products[]['price'] = $product_data->price;
                        }
                    }                    
                    $subsections[]['name'] = $sub_category_data->sub_category_name;
                    $subsections[]['items'] = $products;
                }
            }
            $items['sections'][]['name'] = $category_data->category_name;
            $items['sections'][]['subsections'] = $subsections;
        }
        
        echo json_encode($items);
        exit;
        echo json_encode(array('status' => 'success', 'message' => $items));
        exit;
    }

    public function send_post() {
        var_dump($this->request->body);
    }

    public function send_put() {
        var_dump($this->put('foo'));
    }

    public function send_get() {
        $array = array("status" => "success", "message" => "Test ok!");
        echo json_encode($array);
    }

}