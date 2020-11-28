<?php

class CartModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('apis/ItemsModel', 'items_m');
    }

    public function addItemToCart($user_id, $item_id, $item_quantity)
    {

        $cart_item_data = $this->checkItemInCart($item_id, $user_id);

        if (!empty($cart_item_data)) {

            $item_data = $this->items_m->fetchItemDetails($item_id);

            $new_item_quantity = $cart_item_data->item_quantity + $item_quantity;

            $item_update_to_cart_data = array(
                'user_id' => $user_id,
                'item_id' => $item_id,
                'item_price' => $item_data->item_price,
                'item_quantity' => $new_item_quantity,
                'item_total' => $new_item_quantity * $item_data->item_price
            );

            $this->db->where('id', $cart_item_data->id);
            $value = $this->db->update('cart_items_tbl', $item_update_to_cart_data);
        } else {

            $item_data = $this->items_m->fetchItemDetails($item_id);

            $item_add_to_cart_data = array(
                'user_id' => $user_id,
                'item_id' => $item_id,
                'item_price' => $item_data->item_price,
                'item_quantity' => $item_quantity,
                'item_total' => $item_quantity * $item_data->item_price
            );

            $value = $this->db->insert('cart_items_tbl', $item_add_to_cart_data);
        }

        if ($value == true) {

            $cart_items_data = $this->fetchCurrentUserCartItems($user_id);

            if (!empty($cart_items_data)) {

                return $cart_items_data;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function fetchCurrentUserCartItems($user_id)
    {

        $this->db->select("cart_items_tbl.* , items_tbl.item_title , items_tbl.item_description , items_tbl.item_image");
        $this->db->from('cart_items_tbl')
            ->join('items_tbl', 'cart_items_tbl.item_id = items_tbl.id', 'left');
        $this->db->where('cart_items_tbl.user_id', $user_id);
        $this->db->order_by("cart_items_tbl.id", "desc");
        $result = $this->db->get();
        $cart_items_data =  $result->result();

        if (!empty($cart_items_data)) {

            return $cart_items_data;
        } else {

            return false;
        }
    }

    public function checkItemInCart($item_id, $user_id)
    {

        $this->db->select("*");
        $this->db->from('cart_items_tbl');
        $this->db->where('user_id', $user_id);
        $this->db->where('item_id', $item_id);
        $result = $this->db->get();
        $cart_item_data =  $result->row();

        if (!empty($cart_item_data)) {

            return $cart_item_data;
        } else {

            return false;
        }
    }

    public function removeItemFromCart($user_id, $item_id)
    {

        $cart_item_data = $this->checkItemInCart($item_id, $user_id);

        if (!empty($cart_item_data)) {

            $value = $this->removeItem($item_id, $user_id);

            if ($value == true) {

                $cart_items_data = $this->fetchCurrentUserCartItems($user_id);

                if (!empty($cart_items_data)) {

                    return $cart_items_data;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function removeItem($item_id, $user_id)
    {

        $this->db->where('item_id', $item_id);
        $this->db->where('user_id', $user_id);
        $value = $this->db->delete('cart_items_tbl');

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function updateItemQuantityInCart($user_id, $item_id, $item_quantity)
    {

        $cart_item_data = $this->checkItemInCart($item_id, $user_id);

        if (!empty($cart_item_data)) {

            $item_data = $this->items_m->fetchItemDetails($item_id);

            $item_update_to_cart_data = array(
                'user_id' => $user_id,
                'item_id' => $item_id,
                'item_price' => $item_data->item_price,
                'item_quantity' => $item_quantity,
                'item_total' => $item_quantity * $item_data->item_price
            );

            $this->db->where('id', $cart_item_data->id);
            $value = $this->db->update('cart_items_tbl', $item_update_to_cart_data);

            if ($value == true) {

                $cart_items_data = $this->fetchCurrentUserCartItems($user_id);

                if (!empty($cart_items_data)) {

                    return $cart_items_data;
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function emptyUserCart($user_id)
    {

        $this->db->where('user_id', $user_id);
        $value = $this->db->delete('cart_items_tbl');

        if ($value == true) {

            return true;
        } else {

            return false;
        }
    }

    public function addItemNote($user_id, $item_id, $item_note)
    {

        $data = array(
            'item_note' => $item_note
        );

        $this->db->where('user_id', $user_id);
        $this->db->where('item_id', $item_id);
        $value = $this->db->update('cart_items_tbl', $data);

        if ($value == true) {
            return true;
        } else {
            return false;
        }
    }
}
