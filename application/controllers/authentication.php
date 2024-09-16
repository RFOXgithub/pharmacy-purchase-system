<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('authentication_model');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if ($session == FALSE) {
            redirect('authentication/process_login');
        } else {
            redirect('welcome');
        }
    }

    public function process_login()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/login');
        } else {

            $nik = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->authentication_model->ambilPengguna($username, $password);

            if ($cek <> 0) {
                $nama = $this->authentication_model->dataPengguna($username);

                $this->session->set_userdata('isLogin', TRUE);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('id_akun', $nama->id_akun);
                $this->session->set_userdata('level', $nama->level);

                redirect('welcome');
            } else {
                echo " <script>
                alert('Login Failed! Check your Username and Password, or contact Admin.');
                history.go(-1);
            </script>";
            }
        }
    }
}
