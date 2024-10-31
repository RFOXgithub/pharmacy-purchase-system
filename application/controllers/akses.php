<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Akses extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('authentication_model');
    }

    public function index()
    {
        $data['title'] = "Akses Page";
        $data['akses'] = $this->authentication_model->selectAll();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('nav/akses', $data);
        $this->load->view('layout/footer');
    }

    public function index_akun()
    {
        $data['title'] = "User Page";
        $data['akun'] = $this->authentication_model->selectAll();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('nav/akun', $data);
        $this->load->view('layout/footer');
    }

    function delete($id)
    {
        $this->authentication_model->deleteAkses($id);
        redirect('akses');
    }

    function deleteAkun($id)
    {
        $this->authentication_model->deleteAkses($id);
        redirect('akses/index_akun');
    }

    function edit($id)
    {
        $data['title'] = "Ubah Akses Pengguna";
        $data['subtitle'] = "Ubah Akses Pengguna";

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        if ($_POST == NULL) {
            $data['akses'] = $this->authentication_model->select($id);
            $data['select_level'] = $this->authentication_model->selectLevelAkses($id);
            $this->load->view('nav/akses_edit', $data);
            $this->load->view('layout/footer');
        } else {
            $this->authentication_model->updateAkses($id);
            redirect('akses');
        }
    }

    public function editAkun($id)
    {
        $data['title'] = "Data Akun";

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        $data['city_options'] = $this->authentication_model->getCityOptions();

        if ($_POST == NULL) {
            $data['akun'] = $this->authentication_model->selectAkun($id);
            $this->load->view('nav/akun_edit', $data);
            $this->load->view('layout/footer');
        } else {
            $this->authentication_model->updateAkun($id);
            redirect('akses/index_akun');
        }
    }

    function addAkun()
    {
        $data['title'] = "Data Akun";

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        $data['city_options'] = $this->authentication_model->getCityOptions();

        if ($_POST == NULL) {
            $this->load->view('nav/akun_add', $data);
            $this->load->view('layout/footer');
        } else {
            $this->authentication_model->insertAkun($_POST);
            redirect('akses/index_akun');
        }
    }

    function detail($username)
    {
        $data['title'] = "Detail Profile";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $data['akun'] = $this->authentication_model->select_by_id_query($username);
        $this->load->view('nav/akun_detail', $data);
        $this->load->view('layout/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */