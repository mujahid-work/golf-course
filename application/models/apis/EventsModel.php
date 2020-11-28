<?php

    class EventsModel extends CI_Model {
        function __construct() {
            parent::__construct();
        }


        public function fetchActiveEvents() {
            
            $this->db->select("*");
            $this->db->from('events_tbl');
            $this->db->where('event_status' , 'Active');
            $this->db->order_by("id", "desc");
            $result = $this->db->get();
            $events_data = $result->result();

            if(!empty($events_data)){
                
                return $events_data;
            }
            else{
                
                return false;
            }
        }

        public function fetchEventDetails($event_id) {
            
            $this->db->select("*");
            $this->db->from('events_tbl');
            $this->db->where('id' , $event_id);
            $result = $this->db->get();
            $event_data = $result->row();

            if(!empty($event_data)){
                
                return $event_data;
            }
            else{
                
                return false;
            }
        }
    }
?>