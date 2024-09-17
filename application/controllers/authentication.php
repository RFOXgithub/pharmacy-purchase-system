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

        $this->form_validation->set_rules('username', 'User ID', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/login');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $cek = $this->authentication_model->ambilPengguna($username, $password);

            if ($cek <> 0) {
                $nama = $this->authentication_model->dataPengguna($username);

                $this->session->set_userdata('isLogin', TRUE);
                $this->session->set_userdata('username', $username);
                $this->session->set_userdata('id_akun', $nama->id_akun);
                $this->session->set_userdata('level', $nama->level);

                redirect('produk');
            } else {
                echo " <script>
                alert('Login Failed! Check your Username and Password, or contact Admin.');
                history.go(-1);
            </script>";
            }
        }
    }

    public function register()
    {
        $data['city_options'] = $this->authentication_model->getCityOptions();

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            //$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            //$this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            //$this->form_validation->set_rules('birth', 'Date of Birth', 'required');
            //$this->form_validation->set_rules('gender', 'Gender', 'required');
            //$this->form_validation->set_rules('address', 'Address', 'required');
            //$this->form_validation->set_rules('city', 'City', 'required');
            //$this->form_validation->set_rules('number', 'Contact No', 'required|numeric');
            //$this->form_validation->set_rules('paypal', 'PayPal ID', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('authentication/register', $data);
            } else {
                $this->authentication_model->insertDataRegist($this->input->post());
                redirect('authentication/process_login');
            }
        } else {
            $this->load->view('authentication/register', $data);
        }
    }
}
