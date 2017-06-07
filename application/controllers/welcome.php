<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('news_model');
        $this -> load -> model('seek_model');
        $this -> load -> model('volunteer_model');
    }

    public function get_info()
    {
        //应用vue-cli脚手架解决跨问题
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        //应用vue-cli脚手架解决跨问题
        $news = $this -> news_model -> get_news();
        $seek = $this -> seek_model -> get_seek();
        $vol = $this -> volunteer_model -> get_volunteer();
        $info = array(
            'news' => $news,
            'seek' => $seek,
            'vol' => $vol
        );
        echo json_encode($info);
    }
}
?>