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

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
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

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function selectAll()
    {
        $this->db->select('*');
        $this->db->from('akses');
        $this->db->join('akun', 'akses.id_akun = akun.id_akun');

        return $this->db->get()->result();
    }

    function deleteAkses($id)
    {
        $this->db->where('id_akun', $id);
        $this->db->delete('akses');

        $this->db->where('id_akun', $id);
        $this->db->delete('akun');
    }


    function selectLevelAkses($id)
    {
        $this->db->select('level');
        $this->db->from('akses');
        $this->db->where(array('id_akun' => $id));
        $id = $this->db->get()->row_array();
        return $id;
    }

    function updateAkses($id)
    {
        $this->db->where('id_akun', $id)->update('akses', $_POST);
    }

    function updateAkun($id)
    {
        $this->db->where('id_akun', $id)->update('akun', $_POST);
    }

    public function select($id)
    {
        $this->db->select('akun.username, akses.password, akses.level');
        $this->db->from('akses');
        $this->db->join('akun', 'akses.id_akun = akun.id_akun');
        $this->db->where('akses.id_akun', $id);

        $query = $this->db->get();
        return $query->row();
    }


    function selectAkun($id)
    {
        return $this->db->get_where('akun', array('id_akun' => $id))->row();
    }

    function insertAkun($data)
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
        );
        $this->db->insert('akses', $akses_data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function select_by_id_query($username)
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('username', $username);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function select_by_real_id_query($id_akun)
    {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('id_akun', $id_akun);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }
}
