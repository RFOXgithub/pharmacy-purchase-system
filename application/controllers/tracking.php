<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('authentication_model');
    }

    public function index()
    {
        $data['title'] = "Tracking Page";

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('nav/tracking', $data);
        $this->load->view('layout/footer');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
