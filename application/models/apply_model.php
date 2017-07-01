<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apply_model extends CI_Model {
    public function get_apply_by_user_id_vol_id($user_id,$vol_id)
    {
        return $this -> db -> get_where('t_apply', array(
            'user_id' => $user_id,
            'volunteer_id' => $vol_id
        )) -> row();
    }


    public function save_apply($user_id,$vol_id,$education,$vol_long,$vol_time,$organization,$medical,$care,$advertise)
    {
        $this -> db -> insert('t_apply', array(
            'user_id' => $user_id,
            'volunteer_id' => $vol_id,
            'education' => $education,
            'vol_long' => $vol_long,
            'vol_time' => $vol_time,
            'vol_organization' => $organization,
            'vol_medical' => $medical,
            'vol_care' => $care,
            'vol_advertise' => $advertise
        ));
        return $this -> db -> affected_rows();
    }






}
?>