<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model {

    public function get_news(){
        $sql = "select * from t_news order by post_date desc limit 3";
        return $this -> db -> query($sql) -> result();
    }

    public function get_news_by_page($offset, $limit)
    {
        $sql = "select * from t_news limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }

    public function get_news_count(){
        $sql = "select * from t_news";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function get_news_by_news_id($news_id){
        return $this -> db -> get_where('t_news', array(
            'news_id' => $news_id
        )) -> row();
    }




}
