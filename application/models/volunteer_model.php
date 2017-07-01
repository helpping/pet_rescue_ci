<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Volunteer_model extends CI_Model {

    public function get_volunteer()
    {
        $sql = "select * from t_volunteer limit 3";
        return $this -> db -> query($sql) -> result();
    }

    public function get_all_volunteer($offset,$limit)
    {
        $sql = "select * from t_volunteer limit $offset,$limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_all_volunteer_count()
    {
        $sql = "select * from t_volunteer";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function get_vol_by_vol_id($vol_id)
    {
        return $this -> db -> get_where('t_volunteer', array(
            'volunteer_id' => $vol_id
        )) -> row();
    }


}
?>