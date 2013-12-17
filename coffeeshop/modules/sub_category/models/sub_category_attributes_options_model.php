<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_category_attributes_options_model extends BF_Model
{

    protected $table = "sub_category_attributes_options";
    
    protected $key = "id";
    protected $soft_deletes = false;
    protected $date_format = "datetime";
    protected $set_created = false;
    protected $set_modified = false;
   
}
