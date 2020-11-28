<?php

    class CategoriesModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        public function fetchActiveMainCategories(){

            $this->db->select("*");
            $this->db->from('main_categories_tbl');
            $this->db->where('main_catg_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $main_catgs_data = $result->result();

            if(!empty($main_catgs_data)){
                
                return $main_catgs_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchActiveSubCategories($main_catg_id){

            $this->db->select("*");
            $this->db->from('sub_categories_tbl');
            $this->db->where('main_catg_id' , $main_catg_id);
            $this->db->where('sub_catg_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $sub_catgs_data = $result->result();

            if(!empty($sub_catgs_data)){
                
                return $sub_catgs_data;
            }
            else{
                
                return false;
            }
        }
    }
?>