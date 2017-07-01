<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seek_model extends CI_Model {

    public function get_seek()
    {
        $sql = "select s.*, i.img_src from t_seek s, t_pet_img i
                where s.seek_id = i.seek_id and i.is_main = 1 
                order by post_date desc limit 3";
        return $this -> db -> query($sql) -> result();
    }

    public function get_seek_information($user_id,$offset,$limit){
        $sql = "select s.*, i.img_src from t_seek s, t_pet_img i
                where s.seek_id = i.seek_id and s.user_id = $user_id
                and i.is_main = 1 order by post_date desc limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_seek_information_count($user_id)
    {
        $sql = "select s.*, i.img_src from t_seek s, t_pet_img i
                where s.seek_id = i.seek_id and s.user_id = $user_id
                and i.is_main = 1 order by post_date desc";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function delete_seek_by_seek_id($seek_id)
    {
        $sql = "delete s, i from t_seek s, t_pet_img i 
                where s.seek_id = i.seek_id and s.seek_id = $seek_id";
        $this->db->query($sql);
        return $this -> db -> affected_rows();

    }

    public function get_all_seek($offset, $limit)
    {
        $sql = "select s.*, i.img_src from t_seek s, t_pet_img i
                where s.seek_id = i.seek_id and i.is_main = 1
                limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_all_seek_count()
    {
        $sql = "select s.*, i.img_src from t_seek s, t_pet_img i
                where s.seek_id = i.seek_id and i.is_main = 1";
        return $this -> db -> query($sql) -> num_rows();
    }


    public function get_seek_by_seek_id($seek_id)
    {
        $seek_detail = $this -> db -> get_where('t_seek', array(
            'seek_id' => $seek_id
        )) -> row();
        $sql = "select img_src from t_pet_img where seek_id = $seek_id";
        $seek_detail -> imgs = $this -> db -> query($sql) -> result();
        return $seek_detail;
    }







}
?>