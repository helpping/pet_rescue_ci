<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cute_model extends CI_Model {

    public function  get_cute_by_cute_type($offset,$limit,$cute_type){
        $sql = "SELECT c.*,(SELECT COUNT(*) FROM t_like WHERE cute_id=c.cute_id) num,
                (SELECT username FROM t_user WHERE user_id=c.user_id) username FROM t_cute c 
                where c.cute_type ='$cute_type'
                limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_cute_by_cute_count_type($cute_type)
    {
        $sql = "SELECT c.*,(SELECT COUNT(*) FROM t_like WHERE cute_id=c.cute_id) num,
                (SELECT username FROM t_user WHERE user_id=c.user_id) username FROM t_cute c 
                where c.cute_type ='$cute_type'";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function save_cute($img_src,$cute_content,$kind)
    {
        $this -> db -> insert('t_cute', array(
            'img_src' => $img_src,
            'description' => $cute_content,
            'cute_type' => $kind
        ));
        return $this -> db -> affected_rows();
    }









}
?>