<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seek_model extends CI_Model {

    public function get_seek()
    {
        $sql = "select * from t_seek order by post_date desc limit 3";
        return $this -> db -> query($sql) -> result();
    }





}
?>