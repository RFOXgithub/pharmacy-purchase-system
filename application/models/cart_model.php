<?php

class Cart_model extends CI_Model
{

    function selectAll()
    {
        return $this->db->order_by('id_cart', 'asc')->get('cart')->result();
    }

    public function insert($id_akun, $id_produk, $quantity)
    {
        $data = [
            'id_akun' => $id_akun,
            'id_produk' => $id_produk,
            'quantity' => $quantity
        ];
        $this->db->insert('cart', $data);
    }

    function delete($id)
    {
        $this->db->where('id_cart', $id);
        $this->db->delete('cart');
    }

    function update($id)
    {
        $this->db->where('id_cart', $id)->update('cart', $_POST);
    }

    function select($id)
    {
        return $this->db->get_where('cart', array('id_cart' => $id))->row();
    }

    function selectAllCartUser($id_akun)
    {
        return $this->db->where('cart.id_akun', $id_akun)
            ->join('produk', 'produk.id_produk = cart.id_produk')
            ->order_by('cart.id_cart', 'asc')
            ->get('cart')
            ->result();
    }

    public function getCartItem($id_akun, $id_produk)
    {
        return $this->db->where('id_akun', $id_akun)
            ->where('id_produk', $id_produk)
            ->get('cart')
            ->row();
    }

    public function updateCartQuantity($id_cart, $newQuantity)
    {
        $this->db->where('id_cart', $id_cart)
            ->update('cart', ['quantity' => $newQuantity]);
    }

    public function incrementCartQuantity($id_cart)
    {
        $this->db->set('quantity', 'quantity + 1', FALSE)
            ->where('id_cart', $id_cart)
            ->update('cart');
    }

    public function decrementCartQuantity($id_cart)
    {
        $this->db->set('quantity', 'quantity - 1', FALSE)
            ->where('id_cart', $id_cart)
            ->update('cart');

        $this->db->where('id_cart', $id_cart);
        $cartItem = $this->db->get('cart')->row();

        if ($cartItem && $cartItem->quantity <= 0) {
            $this->db->delete('cart', ['id_cart' => $id_cart]);
        }
    }

    public function getTotalCartQuantity($id_akun)
    {
        return $this->db->select_sum('quantity')
            ->where('id_akun', $id_akun)
            ->get('cart')
            ->row()
            ->quantity;
    }

    public function updateProductStock($product_id, $remainingQuantity)
    {
        $this->db->where('id_produk', $product_id);
        $this->db->update('produk', ['jumlah' => $remainingQuantity]);
    }
}
