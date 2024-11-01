<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('authentication_model');
        $this->load->model('cart_model');

        $input = $this->session->userdata('username');
        $pengguna = $this->authentication_model->dataPengguna($input);
        $this->id_akun = $pengguna ? $pengguna->id_akun : null;
    }

    public function index()
    {
        $data['title'] = "Product Page";
        $data['product'] = $this->produk_model->getAllProduct();

        $data['kategori_options'] = $this->produk_model->getKategoriOptions();

        if ($this->id_akun) {
            $data['totalQuantity'] = $this->cart_model->getTotalCartQuantity($this->id_akun);
        } else {
            $data['totalQuantity'] = [];
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('home/home', $data);
        $this->load->view('layout/footer');
    }

    public function index_katalog()
    {
        $data['title'] = "Katalog Page";
        $data['product'] = $this->produk_model->getAllKatalog();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('nav/katalog', $data);
        $this->load->view('layout/footer');
    }

    public function getProductDetails($id)
    {
        $data['product'] = $this->produk_model->getProductById($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('home/home_detail', $data);
        $this->load->view('layout/footer');
    }

    function deleteProduk($id)
    {
        $this->produk_model->delete($id);
        redirect('produk/index_katalog');
    }

    function editProduk($id)
    {
        $data['title'] = "Ubah Katalog";
        $data['produk'] = $this->produk_model->select($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        $data['kategori_options'] = $this->produk_model->getKategoriOptions();

        $config['upload_path']   = './img/produk_upload/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 5000;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if ($this->input->post() == NULL) {
            $this->load->view('nav/katalog_edit', $data);
            $this->load->view('layout/footer');
            return;
        }

        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {
                $data['upload_error'] = $this->upload->display_errors();
                $this->load->view('nav/katalog_edit', $data);
                $this->load->view('layout/footer');
                return;
            } else {
                $gambar = $this->upload->data('file_name');
            }
        } else {
            $gambar = null;
        }

        $this->produk_model->update($id, $gambar);
        redirect('produk/index_katalog');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
