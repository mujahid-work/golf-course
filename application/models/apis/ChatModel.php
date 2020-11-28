<?php

class ChatModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function saveMessage($chat_data)
    {

        $result = $this->db->insert('chat_tbl', $chat_data);

        if ($result ==  true) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchOrderBasedChat($order_no)
    {
        $this->db->select("*");
        $this->db->from('chat_tbl');
        $this->db->where('order_no', $order_no);
        // $this->db->order_by("id", "desc");
        $result = $this->db->get();
        $orders_data =  $result->result();

        if (!empty($orders_data)) {

            return $orders_data;
        } else {

            return false;
        }
    }

    public function fetchChatHeads($user_id)
    {
        $this->db->select("sales_order_tbl.order_no");
        $this->db->from('chat_tbl')
            ->join('sales_order_tbl', 'sales_order_tbl.order_no = chat_tbl.order_no');
        $this->db->where('sales_order_tbl.user_id', $user_id);
        $this->db->order_by("sales_order_tbl.id", "desc");
        $this->db->group_by("sales_order_tbl.order_no");
        $result = $this->db->get();
        $chat_heads_data =  $result->result();

        if (!empty($chat_heads_data)) {

            return $chat_heads_data;
        } else {

            return false;
        }
    }
}
