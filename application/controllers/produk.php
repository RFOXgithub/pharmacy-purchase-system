<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('authentication_model');
    }
    public function index()
    {
        $this->load->view('home/home');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */