<?php

class checkout_model extends CI_Model
{

    function selectAll()
    {
        return $this->db->order_by('id_checkout', 'asc')->get('checkout')->result();
    }

    public function insert($id_akun, $total_amount, $payment_status, $payment_method)
    {
        $data = [
            'id_akun' => $id_akun,
            'total_amount' => $total_amount,
            'payment_status' => $payment_status,
            'checkout_Date' =>  date('Y-m-d H:i:s'),
            'payment_method' => $payment_method,
        ];
        $this->db->insert('checkout', $data);
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
}
