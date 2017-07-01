<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//应用vue-cli脚手架解决跨问题
header('Access-Control-Allow-Origin:* ');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
//应用vue-cli脚手架解决跨问题
class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('user_model');
        $this -> load -> model('news_model');
        $this -> load -> model('seek_model');
        $this -> load -> model('volunteer_model');
    }

    public function login()
    {
        $username = $this -> input -> post('username');
        $password = $this -> input -> post('password');
        $row = $this -> user_model -> get_user_by_username_password($username,$password);
        if($row){
            $this -> session -> set_userdata('loginedUser', $row);
            echo 'success';
        }else{
            echo 'fail';
        }
    }

    public function check_login()
    {
        $loginedUser = $this -> session -> userdata('loginedUser');
        if($loginedUser){
            echo 'logined';
        }else{
            echo 'nologin';
        }
    }

    public function check_reg()
    {
        $username = $this -> input -> get('username');
        $row = $this -> user_model -> get_user_by_username($username);
        if($row){
            echo 'yes';
        }else{
            echo 'no';
        }
    }

    public function do_reg()
    {
        $username = $this -> input -> post('username');
        $password = $this -> input -> post('password');
        $email = $this -> input -> post('email');
        $row = $this -> user_model -> save_user($username,$password,$email);
        if($row > 0){
            echo 'success';
        }



    }





//    public function get_user_info()
//    {
//        header('Access-Control-Allow-Origin:* ');
//        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
//        $loginedUser = $this -> session -> userdata('loginedUser');
//        if($loginedUser){
//            echo json_encode($loginedUser);
//        }else{
//            echo '456';
//        }
//    }



    public function get_info()
    {
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

    public function get_seek_information(){
        $user_id = $this -> uri -> segment(3);
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $seekInfoCount = $this -> seek_model -> get_seek_information_count($user_id);
        $total_page = ceil($seekInfoCount / $page_size);
        $seekInfo = $this -> seek_model -> get_seek_information($user_id,($page-1)*$page_size,$page_size);
        if($total_page == $page){
            $seekInformation = array(
                'seekInfo' => $seekInfo,
                'isEnd' => true
            );
        }else{
            $seekInformation = array(
                'seekInfo' => $seekInfo,
                'isEnd' => false
            );
        }
        echo json_encode($seekInformation);
    }

    public function delete_seek()
    {
        $seek_id = $this -> input -> get('seekId');
        $row = $this -> seek_model -> delete_seek_by_seek_id($seek_id);
        if($row > 0){
            echo 'success';
        }

    }
















}
?>