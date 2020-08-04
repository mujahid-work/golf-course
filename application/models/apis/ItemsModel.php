<?php

    class ItemsModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }


        public function fetchActiveItems($sub_catg_id,$main_catg_id) {
            
            $this->db->select("items_tbl.* , main_categories_tbl.main_catg_title , sub_categories_tbl.sub_catg_title");
            $this->db->from('items_tbl')
            ->join('main_categories_tbl', 'items_tbl.main_catg_id = main_categories_tbl.id')
            ->join('sub_categories_tbl', 'items_tbl.sub_catg_id = sub_categories_tbl.id');
            $this->db->where('items_tbl.sub_catg_id' , $sub_catg_id);
            $this->db->where('items_tbl.main_catg_id' , $main_catg_id);
            $this->db->where('items_tbl.item_status' , 'Active');
            $this->db->order_by("items_tbl.id", "desc");
            $result = $this->db->get();
            return $result->result();
        }

        public function fetchItemDetails($item_id) {
            
            $this->db->select("items_tbl.* , main_categories_tbl.main_catg_title , sub_categories_tbl.sub_catg_title");
            $this->db->from('items_tbl')
            ->join('main_categories_tbl', 'items_tbl.main_catg_id = main_categories_tbl.id')
            ->join('sub_categories_tbl', 'items_tbl.sub_catg_id = sub_categories_tbl.id');
            $this->db->where('items_tbl.id' , $item_id);
            $result = $this->db->get();
            return $result->row();
        }
    }
?>