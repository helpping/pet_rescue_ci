<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

header('Access-Control-Allow-Origin:* ');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
class Adoption extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('pet_model');
        $this -> load -> model('user_model');
    }

    //个人领养
    public function get_no_pass_adoptions()
    {
        $user_id = $this -> uri -> segment(3);
        $no_pass_page = $this -> input -> get('noPassPage');
        $no_pass_page_size = $this -> input -> get('noPassPageSize');
        $no_pass_adoptions = $this -> pet_model -> get_no_pass_adoptions($user_id,($no_pass_page-1)*$no_pass_page_size,$no_pass_page_size);
        $no_pass_adoptions_count = $this -> pet_model -> get_no_pass_adoptions_count($user_id);
        $no_pass_info = array(
            'noPassAdoptions' => $no_pass_adoptions,
            'noPassAdoptionCount' => $no_pass_adoptions_count
        );
        echo json_encode($no_pass_info);
    }

    public function get_pass_adoptions()
    {
        $user_id = $this -> uri -> segment(3);
        $pass_page = $this -> input -> get('passPage');
        $pass_page_size = $this -> input -> get('passPageSize');
        $pass_adoptions = $this -> pet_model -> get_pass_adoptions($user_id,($pass_page-1)*$pass_page_size,$pass_page_size);
        $pass_adoptions_count = $this -> pet_model -> get_pass_adoptions_count($user_id);
        $pass_info = array(
            'passAdoptions' => $pass_adoptions,
            'passAdoptionsCount' => $pass_adoptions_count
        );
        echo json_encode($pass_info);

    }





    //所有领养信息
    public function get_adopt()
    {
        $pet_type = $this -> input -> get('petType');
        $pet_color = $this -> input -> get('petColor');
        $petAge = $this -> input -> get('petAge');
        $page = $this -> input -> get('page');
        $page_size = 4;
        if($petAge == 1){
            $minAge=0;
            $maxAge=1;
        }else if($petAge == 2){
            $minAge=1;
            $maxAge=3;
        }else if($petAge == 3){
            $minAge=3;
            $maxAge=8;
        }else if($petAge == 4){
            $minAge=8;
            $maxAge=999;
        }

        if($pet_type == 0 && $pet_color == 0 && $petAge == 0){
            $adopt_count = $this -> pet_model -> get_all_adopt_count();
            $adopt = $this -> pet_model -> get_all_adopt(($page-1)*$page_size, $page_size);
        }else if($pet_type != 0 && $pet_color == 0 && $petAge == 0){
            $adopt_count = $this -> pet_model -> get_adopt_by_pet_type_count($pet_type);
            $adopt = $this -> pet_model -> get_adopt_by_pet_type(($page-1)*$page_size,$page_size,$pet_type);
        }else if($pet_type != 0 && $pet_color != 0 && $petAge == 0){
            $adopt_count = $this -> pet_model -> get_adopt_by_pet_type_pet_color_count($pet_type,$pet_color);
            $adopt = $this -> pet_model -> get_adopt_by_pet_type_pet_color(($page-1)*$page_size,$page_size,$pet_type,$pet_color);
        }else if($pet_type != 0 && $pet_color == 0 && $petAge != 0){
            $adopt_count = $this -> pet_model -> get_adopt_by_pet_type_pet_age_count($pet_type,$minAge,$maxAge);
            $adopt = $this -> pet_model -> get_adopt_by_pet_type_pet_age(($page-1)*$page_size,$page_size,$pet_type,$minAge,$maxAge);
        }else if($pet_type != 0 && $pet_color != 0 && $petAge != 0){
            $adopt_count = $this -> pet_model -> get_adopt_by_all_classify_count($pet_type,$pet_color,$minAge,$maxAge);
            $adopt = $this -> pet_model -> get_adopt_by_all_classify(($page-1)*$page_size,$page_size,$pet_type,$pet_color,$minAge,$maxAge);
        }else if($pet_type == 0 && ($pet_color != 0 || $petAge != 0)){
            $adopt_count = $this -> pet_model -> get_all_adopt_count();
            $adopt = $this -> pet_model -> get_all_adopt(($page-1)*$page_size, $page_size);

        }

        $total_page = ceil($adopt_count / $page_size);
        if($total_page == $page){
            $adoptInfo = array(
                'adopt' => $adopt,
                'isEnd' => true,

            );
        }else{
            $adoptInfo = array(
                'adopt' => $adopt,
                'isEnd' => false,

            );
        }
        echo json_encode($adoptInfo);
    }


    public function get_adopt_detail(){
        $pet_id = $this -> uri -> segment(3);
        $details = $this -> pet_model -> get_adopt_detail($pet_id);
        echo json_encode(array(
            'adoptDetails' => $details
        ));
    }

    public function upload_img()
    {
        $config['upload_path'] = './uploads/user/';//设置上传路径
        $config['allowed_types'] = 'gif|jpg|png';//设置上传文件的格式
        $config['max_size'] = '3072';//设置文件的大小
        $config['file_name'] = date("YmdHis") . '_' . rand(10000,99999);//设置文件的文件名
        $this->load->library('upload', $config);
        $this -> upload -> do_upload('img');//表单里的name属性值
        $upload_data = $this -> upload -> data();

        if($upload_data['file_size'] > 0){
            $photo_url = 'uploads/user/' . $upload_data['file_name'];
            echo $photo_url;
        }
    }

    public function delete_img(){
        $img_src = $this -> input -> get('imgSrc');
        if(file_exists($img_src)){
            unlink($img_src);
        }
    }

    public function add_user_info()
    {
        $user_id = 1;
        $front_img_src = $this -> input -> post('frontImgSrc');
        $behind_img_src = $this -> input -> post('behindImgSrc');
        $ID_number = $this  -> input ->post('idNumber');
        $address = $this  -> input ->post('address');
        $income = $this  -> input ->post('income');
        $email = $this  -> input ->post('email');
        $row = $this -> user_model -> add_user_info($user_id,$front_img_src,$behind_img_src,$ID_number,$address,$income,$email);
        if($row > 0){
            echo 'success';
        }

    }










}
?>