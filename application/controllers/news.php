<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller {

    public function get_news()
    {
        //应用vue-cli脚手架解决跨问题
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        //应用vue-cli脚手架解决跨问题
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $this -> load -> model('news_model');
        $news_count = $this -> news_model -> get_news_count();
        $news_page = ceil($news_count / $page_size);
        $news = $this -> news_model -> get_all_news(($page-1)*$page_size, $page_size);
        if($page == $news_page){
            $news_info = array(
                'news' => $news,
                'isEnd' => true
            );
        }else{
            $news_info = array(
                'news' => $news,
                'isEnd' => false
            );
        }
        echo json_encode($news_info);
    }
}
?>