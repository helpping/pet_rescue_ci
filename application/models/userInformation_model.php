<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserInformation_model extends CI_Model {

    public function get_user_name()
    {
        $sql = "select * from t_user where user_id = 1";
        return $this -> db -> query($sql) -> row();
    }





}
?>