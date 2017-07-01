<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserInformation extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('userInformation_model');
    }
    public function get_username()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $username = $this -> userInformation_model -> get_user_name();
        echo json_encode($username);
    }





}
?>