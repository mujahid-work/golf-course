<?php

    class EventsModel extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function addEvent($event_data){

            $value=$this->db->insert('events_tbl',$event_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }

        public function fetchAllEvents(){

            $this->db->select("*");
            $this->db->from('events_tbl');
            $this->db->order_by("events_tbl.id", "desc");
            $result = $this->db->get();
            $all_events_data =  $result->result();

            if(!empty($all_events_data)){
                
                return $all_events_data;
            }
            else{
                
                return false;
            }
        }

        public function enableEvent($data,$event_id){

            $result = $this->db->update('events_tbl',$data,array('id'=>$event_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function disableEvent($data,$event_id){

            $result = $this->db->update('events_tbl',$data,array('id'=>$event_id));

            if($result == true){
                
                return true;
            }
            else{
                
                return false;
            }
        }

        public function fetchSingleEvent($event_id){

            $this->db->select("*");
            $this->db->from('events_tbl');
            $this->db->where('id',$event_id);
            $result = $this->db->get();
            $single_event_data =  $result->row();

            if(!empty($single_event_data)){
                
                return $single_event_data;
            }
            else{
                
                return false;
            }
        }

        public function updateEvent($event_data,$event_id){

            $this->db->where('id',$event_id);
            $value=$this->db->update('events_tbl',$event_data);

			if($value==true){
				
				return true;
			}
			else{
				
				return false;
			}
        }
    }
?>