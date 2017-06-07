<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('news_model');
    }
    public function get_all_news()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $news_count = $this -> news_model -> get_news_count();
        $news = $this -> news_model -> get_news_by_page(($page-1)*$page_size, $page_size);
        $total_page = ceil($news_count / $page_size);
        if($page == $total_page){
            $news_info = array(
                'isEnd' => true,
                'news' => $news
            );
        }else{
            $news_info = array(
                'isEnd' => false,
                'news' => $news
            );
        }
        echo json_encode($news_info);
    }

    public function get_news_detail()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $news_id = $this -> uri -> segment(3);
        $news_detail = $this -> news_model -> get_news_by_news_id($news_id);
        echo json_encode($news_detail);
    }



}
?>