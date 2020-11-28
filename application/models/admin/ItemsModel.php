<?php

    class ItemsModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function addItem($item_data){

            $value=$this->db->insert('items_tbl',$item_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }

        public function fetchAllItems(){

            $this->db->select("items_tbl.*,main_categories_tbl.main_catg_title,sub_categories_tbl.sub_catg_title");
            $this->db->from('items_tbl')
                ->join('main_categories_tbl', 'items_tbl.main_catg_id = main_categories_tbl.id' , 'left')
                ->join('sub_categories_tbl', 'items_tbl.sub_catg_id = sub_categories_tbl.id' , 'left');
            $this->db->order_by("items_tbl.id", "desc");
            $result = $this->db->get();
            $all_items_data =  $result->result();

            if(!empty($all_items_data)){
                
                return $all_items_data;
            }
            else{
                
                return false;
            }
        }

        public function enableItem($data,$item_id){

            $result = $this->db->update('items_tbl',$data,array('id'=>$item_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableItem($data,$item_id){

            $result = $this->db->update('items_tbl',$data,array('id'=>$item_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleItem($item_id){

            $this->db->select("*");
            $this->db->from('items_tbl');
            $this->db->where('id',$item_id);
            $result = $this->db->get();
            $single_item_data =  $result->row();

            if(!empty($single_item_data)){
                
                return $single_item_data;
            }
            else{
                
                return false;
            }
        }

        public function updateItem($item_data,$item_id){

            $this->db->where('id',$item_id);
            $value=$this->db->update('items_tbl',$item_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }
    }
?>