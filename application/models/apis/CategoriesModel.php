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
            return $result->result();
        }

        public function fetchActiveSubCategories($main_catg_id){

            $this->db->select("*");
            $this->db->from('sub_categories_tbl');
            $this->db->where('main_catg_id' , $main_catg_id);
            $this->db->where('sub_catg_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            return $result->result();
        }
    }
?>