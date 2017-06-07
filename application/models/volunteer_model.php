<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Volunteer_model extends CI_Model {
    public function get_volunteer()
    {
        $sql = "select * from t_volunteer limit 3";
        return $this -> db -> query($sql) -> result();
    }







}
?>