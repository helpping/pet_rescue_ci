<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin:* ');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');

class Seek extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('seek_model');
    }
    public function get_all_seek()
    {
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $all_seek = $this -> seek_model -> get_all_seek(($page-1)*$page_size, $page_size);
        $all_seek_count = $this -> seek_model -> get_all_seek_count();
        $total_page = ceil($all_seek_count / $page_size);
        if($total_page == $page){
            $all_seek_info = array(
                'allSeek' => $all_seek,
                'isEnd' => true
            );
        }else{
            $all_seek_info = array(
                'allSeek' => $all_seek,
                'isEnd' => false
            );
        }
        echo json_encode($all_seek_info);
    }

    public function get_seek_detail()
    {
        $seek_id = $this -> uri -> segment(3);
        $seek_detail = $this -> seek_model -> get_seek_by_seek_id($seek_id);
        echo json_encode($seek_detail);

    }











}
?>