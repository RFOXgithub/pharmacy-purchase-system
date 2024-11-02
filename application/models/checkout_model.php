<?php

class checkout_model extends CI_Model
{

    function selectAll()
    {
        return $this->db->order_by('id_checkout', 'asc')->get('checkout')->result();
    }

    public function insert($id_akun, $total_amount, $payment_method, $cartItems)
    {
        $data = [
            'id_akun' => $id_akun,
            'total_amount' => $total_amount,
            'payment_method' => $payment_method,
            'checkout_Date' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('checkout', $data);

        $id_checkout = $this->db->insert_id(); 

        foreach ($cartItems as $item) {
            $dataDetail = [
                'id_produk' => $item->id_produk,
                'id_checkout' => $id_checkout,
                'nama_produk' => $item->nama_produk,
                'quantity' => $item->quantity,
                'harga' => $item->harga,
            ];
            $this->db->insert('checkout_detail', $dataDetail);
        }

        $this->deleteCartItems($id_akun);

        return $id_checkout; 
    }


    private function deleteCartItems($id_akun)
    {
        $this->db->delete('cart', ['id_akun' => $id_akun]);
    }

    function delete($id)
    {
        $this->db->where('id_checkout', $id);
        $this->db->delete('checkout');
    }

    function update($id)
    {
        $this->db->where('id_checkout', $id)->update('checkout', $_POST);
    }

    function select($id)
    {
        return $this->db->get_where('checkout', array('id_checkout' => $id))->row();
    }

    public function selectAllCheckoutItemsUser($id_checkout = 1)
    {
        return $this->db->select('checkout_detail.*, checkout.payment_method')
            ->from('checkout_detail')
            ->join('checkout', 'checkout.id_checkout = checkout_detail.id_checkout')
            ->where('checkout_detail.id_checkout', $id_checkout)
            ->order_by('checkout_detail.id_checkout', 'asc')
            ->get()
            ->result();
    }

    public function getPaymentMethodByCheckoutId($id_checkout)
    {
        return $this->db->select('payment_method')
            ->from('checkout')
            ->where('id_checkout', $id_checkout)
            ->get()
            ->row();
    }
}
