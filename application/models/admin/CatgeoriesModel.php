<?php

    class CatgeoriesModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function addMainCategory($main_catg_data){

            $value=$this->db->insert('main_categories_tbl',$main_catg_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }

        public function updateMainCategory($main_catg_data,$main_catg_id){

            $this->db->where('id',$main_catg_id);
            $value=$this->db->update('main_categories_tbl',$main_catg_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }

        public function fetchActiveMainCategories(){

            $this->db->select("*");
            $this->db->from('main_categories_tbl');
            $this->db->where('main_catg_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $main_active_catgs_data =  $result->result();

            if(!empty($main_active_catgs_data)){
                
                return $main_active_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchAllMainCategories(){

            $this->db->select("*");
            $this->db->from('main_categories_tbl');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $main_all_catgs_data =  $result->result();

            if(!empty($main_all_catgs_data)){
                
                return $main_all_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchAllSubCategoriesForMainCatgeories(){

            $this->db->select("*");
            $this->db->from('sub_categories_tbl');
            $result = $this->db->get();
            $this->db->order_by("id", "desc");
            $sub_active_catgs_data =  $result->result();

            if(!empty($sub_active_catgs_data)){
                
                return $sub_active_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function enableMainCategory($data,$main_catg_id){

            $result = $this->db->update('main_categories_tbl',$data,array('id'=>$main_catg_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableMainCategory($data,$main_catg_id){

            $result = $this->db->update('main_categories_tbl',$data,array('id'=>$main_catg_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleMainCategory($main_catg_id){

            $this->db->select("*");
            $this->db->from('main_categories_tbl');
            $this->db->where('id',$main_catg_id);
            $result = $this->db->get();
            $single_main_catg_data =  $result->row();

            if(!empty($single_main_catg_data)){
                
                return $single_main_catg_data;
            }
            else{
                
                return false;
            }
        }

        public function addSubCategory($sub_catg_data){

            $value=$this->db->insert('sub_categories_tbl',$sub_catg_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }

        public function fetchAllSubCategories(){

            $this->db->select("sub_categories_tbl.* , main_categories_tbl.main_catg_title");
            $this->db->from('sub_categories_tbl')
                ->join('main_categories_tbl', 'sub_categories_tbl.main_catg_id = main_categories_tbl.id' , 'left');
            $this->db->order_by("sub_categories_tbl.id", "desc");
            $result = $this->db->get();
            $sub_all_catgs_data =  $result->result();

            if(!empty($sub_all_catgs_data)){
                
                return $sub_all_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchActiveSubCategories(){

            $this->db->select("*");
            $this->db->from('sub_categories_tbl');
            $this->db->where('sub_catg_status','Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $sub_active_catgs_data =  $result->result();

            if(!empty($sub_active_catgs_data)){
                
                return $sub_active_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function enableSubCategory($data,$sub_catg_id){

            $result = $this->db->update('sub_categories_tbl',$data,array('id'=>$sub_catg_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableSubCategory($data,$sub_catg_id){

            $result = $this->db->update('sub_categories_tbl',$data,array('id'=>$sub_catg_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleSubCategory($sub_catg_id){

            $this->db->select("*");
            $this->db->from('sub_categories_tbl');
            $this->db->where('id',$sub_catg_id);
            $result = $this->db->get();
            $single_sub_catg_data =  $result->row();

            if(!empty($single_sub_catg_data)){
                
                return $single_sub_catg_data;
            }
            else{
                
                return false;
            }
        }

        public function updateSubCategory($sub_catg_data,$sub_catg_id){

            $this->db->where('id',$sub_catg_id);
            $value=$this->db->update('sub_categories_tbl',$sub_catg_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }
        
        
    }
?>