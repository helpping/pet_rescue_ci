<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin:* ');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type');
class Volunteer extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('volunteer_model');
        $this -> load -> model('apply_model');
    }

    public function get_all_volunteer()
    {
        $page = $this -> input -> get('page');
        $page_size = $this -> input -> get('pageSize');
        $vol = $this -> volunteer_model -> get_all_volunteer(($page-1)*$page_size,$page_size);
        $vol_count = $this -> volunteer_model -> get_all_volunteer_count();
        $total_page = ceil($vol_count / $page_size);
        if($total_page == $page){
            $vol_info = array(
                'vol' => $vol,
                'isEnd' => true
            );
        }else{
            $vol_info = array(
                'vol' => $vol,
                'isEnd' => false
            );
        }
        echo json_encode($vol_info);
    }

    public function get_volunteer_detail()
    {
        $vol_id = $this -> uri -> segment(3);
        $vol_detail = $this -> volunteer_model -> get_vol_by_vol_id($vol_id);
        echo json_encode($vol_detail);
    }

    public function add_volunteer_info()
    {
        $user_id = 1;
        $vol_id = $this -> uri -> segment(3);
        $education = $this -> input -> post('education');
        $vol_long = $this -> input -> post('volLong');
        $vol_time = $this -> input -> post('volTime');
        $organization = $this -> input -> post('organization');
        $medical = $this -> input -> post('medical');
        $care = $this -> input -> post('care');
        $advertise = $this -> input -> post('advertise');
//        echo $organization.':'.$medical;
//        die();
        $result = $this -> apply_model -> get_apply_by_user_id_vol_id($user_id,$vol_id);
        if($result){
            echo 'applyed';
        }else{
            $row = $this -> apply_model -> save_apply($user_id,$vol_id,$education,$vol_long,$vol_time,$organization,$medical,$care,$advertise);
            if($row > 0){
                echo 'success';
            }
        }
    }




}
?>