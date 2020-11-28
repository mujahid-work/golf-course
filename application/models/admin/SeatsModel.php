<?php

class SeatsModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function addSeat($seat_data)
    {

        $value = $this->db->insert('seats_tbl', $seat_data);

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function fetchAllSeats()
    {

        $this->db->select("seats_tbl.* , seat_types_tbl.seat_type_title , areas_tbl.area_title");
        $this->db->from('seats_tbl')
            ->join('areas_tbl', 'areas_tbl.id = seats_tbl.area_id', 'left')
            ->join('seat_types_tbl', 'seat_types_tbl.id = seats_tbl.seat_type', 'left');
        $this->db->order_by("seats_tbl.id", "desc");
        $result = $this->db->get();
        $all_seats_data =  $result->result();

        if (!empty($all_seats_data)) {

            return $all_seats_data;
        } else {

            return false;
        }
    }

    public function deleteSeat($seat_id)
    {

        $this->db->where('id', $seat_id);
        $result = $this->db->delete('seats_tbl');

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function fetchSingleSeat($seat_id)
    {

        $this->db->select("*");
        $this->db->from('seats_tbl');
        $this->db->where('id', $seat_id);
        $result = $this->db->get();
        $single_seat_data =  $result->row();

        if (!empty($single_seat_data)) {

            return $single_seat_data;
        } else {

            return false;
        }
    }

    public function updateSeat($seat_data, $seat_id)
    {

        $this->db->where('id', $seat_id);
        $value = $this->db->update('seats_tbl', $seat_data);

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function addSeatType($seat_type_data)
    {

        $value = $this->db->insert('seat_types_tbl', $seat_type_data);

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function fetchAllSeatTypes()
    {

        $this->db->select("seat_types_tbl.* , areas_tbl.area_title");
        $this->db->from('seat_types_tbl')
            ->join('areas_tbl', 'areas_tbl.id=seat_types_tbl.area_id', 'left');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $all_seat_types_data =  $result->result();

        if (!empty($all_seat_types_data)) {

            return $all_seat_types_data;
        } else {

            return false;
        }
    }

    public function fetchAllActiveSeatTypes()
    {

        $this->db->select("*");
        $this->db->from('seat_types_tbl');
        $this->db->where('seat_type_status', 'Active');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $all_active_seat_types_data =  $result->result();

        if (!empty($all_active_seat_types_data)) {

            return $all_active_seat_types_data;
        } else {

            return false;
        }
    }

    public function fetchSingleSeatType($seat_type_id)
    {

        $this->db->select("*");
        $this->db->from('seat_types_tbl');
        $this->db->where('id', $seat_type_id);
        $result = $this->db->get();
        $single_seat_type_data =  $result->row();

        if (!empty($single_seat_type_data)) {

            return $single_seat_type_data;
        } else {

            return false;
        }
    }

    public function updateSeatType($seat_type_data, $seat_type_id)
    {

        $this->db->where('id', $seat_type_id);
        $value = $this->db->update('seat_types_tbl', $seat_type_data);

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function enableSeatType($data, $seat_type_id)
    {

        $result = $this->db->update('seat_types_tbl', $data, array('id' => $seat_type_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function disableSeatType($data, $seat_type_id)
    {

        $result = $this->db->update('seat_types_tbl', $data, array('id' => $seat_type_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function addArea($area_data)
    {

        $value = $this->db->insert('areas_tbl', $area_data);

        if ($value == true) {

            $last_inserted_id = $this->db->insert_id();
            return $last_inserted_id;
        } else {

            return false;
        }
    }

    public function addAreaTimings($area_timings_data)
    {

        for ($i = 0; $i < sizeof($area_timings_data); $i++) {
            $value = $this->db->insert('area_timings_tbl', $area_timings_data[$i]);
        }
        if ($value == true) {
            return true;
        } else {

            return false;
        }
    }

    public function fetchSingleArea($area_id)
    {

        $this->db->select("*");
        $this->db->from('areas_tbl')
            ->join('area_timings_tbl', 'areas_tbl.id=area_timings_tbl.area_id', 'left');
        $this->db->where('areas_tbl.id', $area_id);
        $result = $this->db->get();
        $single_area_data =  $result->result();

        if (!empty($single_area_data)) {

            return $single_area_data;
        } else {

            return false;
        }
    }

    public function fetchAllAreas()
    {

        $this->db->select("*");
        $this->db->from('areas_tbl');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $all_areas_data =  $result->result();

        if (!empty($all_areas_data)) {

            return $all_areas_data;
        } else {

            return false;
        }
    }

    public function fetchAllActiveAreas()
    {

        $this->db->select("*");
        $this->db->from('areas_tbl');
        $this->db->where('area_status', 'Active');
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $all_active_areas_data =  $result->result();

        if (!empty($all_active_areas_data)) {

            return $all_active_areas_data;
        } else {

            return false;
        }
    }

    public function fetchAllSeatTypesForArea()
    {

        $this->db->select("*");
        $this->db->from('seat_types_tbl');
        $result = $this->db->get();
        $this->db->order_by("id", "desc");
        $all_areas_data =  $result->result();

        if (!empty($all_areas_data)) {

            return $all_areas_data;
        } else {

            return false;
        }
    }

    public function updateArea($area_data, $area_id)
    {

        $this->db->where('id', $area_id);
        $value = $this->db->update('areas_tbl', $area_data);

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function updateAreaTimings($area_timings_data)
    {

        for ($i = 0; $i < sizeof($area_timings_data); $i++) {
            $this->db->where('area_id', $area_timings_data[$i]['area_id']);
            $this->db->where('day', $area_timings_data[$i]['day']);
            $value = $this->db->update('area_timings_tbl', $area_timings_data[$i]);
        }
        if ($value == true) {
            return true;
        } else {

            return false;
        }
    }

    public function enableArea($data, $area_id)
    {

        $result = $this->db->update('areas_tbl', $data, array('id' => $area_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function disableArea($data, $area_id)
    {

        $result = $this->db->update('areas_tbl', $data, array('id' => $area_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function openArea($data, $area_id)
    {

        $result = $this->db->update('areas_tbl', $data, array('id' => $area_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }

    public function closeArea($data, $area_id)
    {

        $result = $this->db->update('areas_tbl', $data, array('id' => $area_id));

        if ($result == true) {

            return true;
        } else {

            return false;
        }
    }
}
