<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

    public function get_user_by_username_password($username, $password)
    {
        return $this -> db -> get_where('t_user', array(
            'username' => $username,
            'password' => $password
        )) -> row();
    }

    public function get_user_by_username($username)
    {
        return $this -> db -> get_where('t_user', array(
            'username' => $username
        )) -> row();
    }

    public function save_user($username,$password,$email)
    {
        $this -> db -> insert('t_user', array(
            'username' => $username,
            'password' => $password,
            'email' => $email
        ));
        return $this -> db -> affected_rows();
    }

    public function add_user_info($user_id,$front_img_src,$behind_img_src,$ID_number,$address,$income,$email)
    {
        $this -> db -> where('user_id', $user_id);
        $this -> db -> update('t_user', array(
            'ID_card_img_front' => $front_img_src,
            'ID_card_img_behind' => $behind_img_src,
            'ID_num' => $ID_number,
            'address' => $address,
            'income' => $income,
            'email' => $email
        ));
        return $this -> db -> affected_rows();
    }



}
?>