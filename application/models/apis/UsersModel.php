<?php

    class UsersModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }

        public function validateUserLogin($data){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where($data);
            $result = $this->db->get();
            return $result->row();
        }

        public function checkExistedEmail($email) {

            $this->db->select('id');
            $this->db->from('users_tbl');
            $this->db->where('email',$email);
            $result = $this->db->get();

            if($result->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function saveUserData($data) {

            $result = $this->db->insert('users_tbl',$data);

            if($result == true){
                return true;
            }
            else{
                return false;
            }
        }

        public function updateLoginTokken($tokken,$user_id){

            $this->db->set('tokken',$tokken);
		    $this->db->where('id', $user_id);
            $result = $this->db->update('users_tbl');
            
            if($result == true){
                return true;
            }
            else{
                return false;
            }
        }

        public function validateUserTokken($data){

            $this->db->select("*");
            $this->db->from('users_tbl');
            $this->db->where($data);
            $result = $this->db->get();
            return $result->row();
        }
    }

?>