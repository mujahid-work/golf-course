<?php

    class LoginModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        public function adminLoginValidate($data){

            $this->db->select("*");
            $this->db->from('admins_tbl');
            $this->db->where($data);
            $result = $this->db->get();
            $admin_data =  $result->row();

            if(!empty($admin_data)){
                return $admin_data;
            }
            else{
                return false;
            }
        }
    }
?>