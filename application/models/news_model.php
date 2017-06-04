<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model {

    public function get_all_news($offset, $limit){
        $sql = "select * from t_news limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_news_count(){
        $sql = "select * from t_news";
        return $this -> db -> query($sql) -> num_rows();
    }






}
