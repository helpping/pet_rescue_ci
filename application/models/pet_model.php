<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pet_model extends CI_Model {
    //个人领养未通过
    public function get_no_pass_adoptions($user_id,$offset,$limit)
    {
       $sql ="select p.*,i.*,u.city from t_pet p,t_user u,t_pet_img i 
              where u.user_id = $user_id and u.user_id = p.user_id 
              and p.pet_id = i.pet_id and i.is_main = 1 and p.is_adopt = 0
              limit $offset, $limit" ;
        return $this -> db -> query($sql) -> result();
    }

    public function get_no_pass_adoptions_count($user_id)
    {
        $sql ="select p.*,i.*,u.city from t_pet p,t_user u,t_pet_img i 
              where u.user_id = $user_id and u.user_id = p.user_id 
              and p.pet_id = i.pet_id and i.is_main = 1 and p.is_adopt = 0" ;
        return $this -> db -> query($sql) -> num_rows();
    }
    //个人领养未通过

    //个人领养通过
    public function get_pass_adoptions($user_id,$offset,$limit)
    {
        $sql ="select p.*,i.*,u.city from t_pet p,t_user u,t_pet_img i 
              where u.user_id = $user_id and u.user_id = p.user_id 
              and p.pet_id = i.pet_id and i.is_main = 1 and p.is_adopt = 1
              limit $offset, $limit" ;
        return $this -> db -> query($sql) -> result();
    }

    public function get_pass_adoptions_count($user_id)
    {
        $sql ="select p.*,i.*,u.city from t_pet p,t_user u,t_pet_img i 
              where u.user_id = $user_id and u.user_id = p.user_id 
              and p.pet_id = i.pet_id and i.is_main = 1 and p.is_adopt = 1" ;
        return $this -> db -> query($sql) -> num_rows();
    }



    //个人领养通过








    //所有领养信息
    public function get_all_adopt($offset,$limit)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }
    public function get_all_adopt_count()
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1";
        return $this -> db -> query($sql) -> num_rows();
    }
    //所有领养信息

    //宠物种类分类
    public function get_adopt_by_pet_type($offset,$limit,$pet_type)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }
    public function get_adopt_by_pet_type_count($pet_type)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type";
        return $this -> db -> query($sql) -> num_rows();
    }
    //宠物种类分类

    //宠物种类、颜色分类
    public function get_adopt_by_pet_type_pet_color_count($pet_type,$pet_color)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_color = $pet_color";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function get_adopt_by_pet_type_pet_color($offset,$limit,$pet_type,$pet_color)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_color = $pet_color 
                limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }
    //宠物种类、颜色分类

    //宠物种类、年龄分类
    public function get_adopt_by_pet_type_pet_age_count($pet_type,$minAge,$maxAge)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_age between $minAge and $maxAge";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function get_adopt_by_pet_type_pet_age($offset,$limit,$pet_type,$minAge,$maxAge)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_age between $minAge and $maxAge
                limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }
    //宠物种类、年龄分类

    //宠物种类、毛色、年龄分类
    public function get_adopt_by_all_classify_count($pet_type,$pet_color,$minAge,$maxAge)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_color = $pet_color 
                and p.pet_age between $minAge and $maxAge";
        return $this -> db -> query($sql) -> num_rows();
    }

    public function get_adopt_by_all_classify($offset,$limit,$pet_type,$pet_color,$minAge,$maxAge)
    {
        $sql = "select p.*, i.img_src from t_pet p, t_pet_img i 
                where p.pet_id = i.pet_id and i.is_main = 1 
                and p.pet_type = $pet_type and p.pet_color = $pet_color
                and p.pet_age between $minAge and $maxAge
                limit $offset, $limit";
        return $this -> db -> query($sql) -> result();
    }
    //宠物种类、毛色、年龄分类


    public function get_adopt_detail($pet_id){
        $pet_detail = $this -> db -> get_where('t_pet', array(
            'pet_id' => $pet_id
        )) -> row();
        $pet_detail -> img = $this -> db -> get_where('t_pet_img', array(
            'pet_id' => $pet_id
        )) -> result();
        return $pet_detail;
    }





























































}
?>