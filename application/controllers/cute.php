<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cute extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('cute_model');
    }

    public function get_cute(){
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $cute_type = $this -> uri -> segment(3);
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $cute_count = $this -> cute_model -> get_cute_by_cute_count_type($cute_type);
        $total_page = ceil($cute_count / $page_size);
        $cute = $this -> cute_model -> get_cute_by_cute_type(($page-1)*$page_size, $page_size,$cute_type);
        if($page == $total_page){
            $cute_info = array(
                'isEnd' => true,
                'cute' => $cute
            );
        }else{
            $cute_info = array(
                'isEnd' => false,
                'cute' => $cute
            );
        }
        echo json_encode($cute_info);
    }


    public function upload_img()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $config['upload_path'] = './uploads/cute/';//设置上传路径
        $config['allowed_types'] = 'gif|jpg|png';//设置上传文件的格式
        $config['max_size'] = '3072';//设置文件的大小
        $config['file_name'] = date("YmdHis") . '_' . rand(10000,99999);//设置文件的文件名
        $this->load->library('upload', $config);
        $this -> upload -> do_upload('img');//表单里的name属性值
        $upload_data = $this -> upload -> data();

        if($upload_data['file_size'] > 0){
            $photo_url = 'uploads/cute/' . $upload_data['file_name'];
            echo $photo_url;
        }
    }

    public function delete_img(){
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $img_src = $this -> input -> get('imgSrc');
        if(file_exists($img_src)){
            unlink($img_src);
        }
    }


    public function push_cute()
    {
        header('Access-Control-Allow-Origin:* ');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
        $img_src = $this -> input -> post('imgSrc');
        $cute_content = $this -> input -> post('cuteContent');
        $kind = $this -> input -> post('kind');
        $row = $this -> cute_model -> save_cute($img_src,$cute_content,$kind);
        if($row > 0){
            echo 'success';
        }
    }













}
?>