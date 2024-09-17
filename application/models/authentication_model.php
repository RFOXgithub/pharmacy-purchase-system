<?php

class Authentication_model extends CI_Model
{

    function __construct()
    {
        //$this->load->model('akses_m');
    }

    var $table = 'akses, akun';

    public function ambilPengguna($username, $password)
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->join('akses', 'akses.id_akun = akun.id_akun', 'inner');
        $this->db->where('akun.username', $username);
        $this->db->where('akses.password', $password);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function dataPengguna($username)
    {
        $this->db->select('akun.username, akses.level, akun.id_akun');
        $this->db->from('akun');
        $this->db->join('akses', 'akses.id_akun = akun.id_akun', 'inner');
        $this->db->where('akun.username', $username);
        $query = $this->db->get();
        return $query->row();
    }

    public function getCityOptions()
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->order_by('id_kota', 'ASC');
        $query = $this->db->get();

        $options = array();
        foreach ($query->result_array() as $row) {
            $options[$row['nama_kota']] = $row['nama_kota'];
        }

        return $options;
    }

    public function insertDataRegist($data)
    {
        $this->db->trans_start();

        $akun_data = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'birth' => $data['birth'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'city' => $data['city'],
            'number' => $data['number'],
            'id_paypal' => $data['id_paypal'],
        );
        $this->db->insert('akun', $akun_data);

        $akun_id = $this->db->insert_id();

        $akses_data = array(
            'id_akun' => $akun_id,
            'password' => $data['password'],
        );
        $this->db->insert('akses', $akses_data);

        // Selesaikan transaksi
        $this->db->trans_complete();

        // Periksa status transaksi
        if ($this->db->trans_status() === FALSE) {
            // Jika terjadi kesalahan, rollback transaksi
            return FALSE;
        } else {
            // Jika semuanya berhasil, transaksi berhasil
            return TRUE;
        }
    }
}
