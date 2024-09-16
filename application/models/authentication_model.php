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
        $this->db->from('akses');
        $this->db->from('akun');
        $this->db->where('akses.id_akun = akun.id_akun');
        $this->db->where('akun.username', $username);
        $this->db->where('akses.password', $password);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function dataPengguna($username)
    {
        $this->db->select('username');
        $this->db->select('level');
        $this->db->select('akun.id_akun');
        $this->db->from('akses');
        $this->db->from('akun');
        $this->db->where('akses.id_akun = akun.id_akun');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }
}
