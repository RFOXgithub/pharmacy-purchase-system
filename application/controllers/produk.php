<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('authentication_model');
        $this->load->model('cart_model');
        $this->load->model('kategori_model');

        $input = $this->session->userdata('username');
        $pengguna = $this->authentication_model->dataPengguna($input);
        $this->id_akun = $pengguna ? $pengguna->id_akun : null;
    }

    public function index()
    {
        # $start_time = microtime(true);
        $data['product'] = $this->produk_model->getAllProduct();
        # $end_time = microtime(true);
         #$execution_time = $end_time - $start_time;
         #echo "Execution Time: " . $execution_time . " seconds";

         #$start_memory = memory_get_usage();
         #$end_memory = memory_get_usage();
         #$memory_used = $end_memory - $start_memory;
         #echo "Memory Usage: " . $memory_used . " bytes";
        #exit();

        $data['title'] = "Product Page";

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

        if ($this->session->userdata('isLogin') == FALSE) {
            redirect('produk/index');
        } else {
            $data['title'] = "Katalog Page";
            $data['product'] = $this->produk_model->getAllKatalog();

            $this->load->view('layout/header', $data);
            $this->load->view('layout/nav');
            $this->load->view('nav/katalog', $data);
            $this->load->view('layout/footer');
        }
    }

    public function getProductDetails($id)
    {
        $data['title'] = "Detail Page";
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

        if ($this->input->post() == NULL) {
            $this->load->view('nav/katalog_edit', $data);
            $this->load->view('layout/footer');
            return;
        }

        $config['upload_path'] = 'D:\Aplikasi\XAMPP\htdocs\WebsiteShopping-Toko-Alat-Kesehatan\img\produk';
        $config['allowed_types'] = 'jpeg|jpg|png|gif|bmp';
        $config['max_size'] = 10000;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {
                $data['upload_error'] = $this->upload->display_errors();
                log_message('error', 'File upload error: ' . $data['upload_error']);
                $this->load->view('nav/katalog_edit', $data);
                $this->load->view('layout/footer');
                return;
            } else {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            }
        } else {
            $gambar = null;
        }

        $this->produk_model->update($id, $gambar);
        redirect('produk/index_katalog');
    }

    function addKatalog()
    {
        $data['title'] = "Tambah Data Aset";

        $this->form_validation->set_rules('nama_produk', 'Nama Aset', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        $dbres = $this->db->order_by('nama_kategori', 'asc')->get('kategori');
        $ddmenu = array();
        foreach ($dbres->result_array() as $tablerow) {
            $ddmenu[$tablerow['id_kategori']] = $tablerow['nama_kategori'];
        }
        $data['options'] = $ddmenu;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('nav/katalog_add', $data);
            $this->load->view('layout/footer');
            return;
        }

        $config['upload_path'] = 'D:\Aplikasi\XAMPP\htdocs\WebsiteShopping-Toko-Alat-Kesehatan\img\produk';
        $config['allowed_types'] = 'jpeg|jpg|png|gif|bmp';
        $config['max_size'] = 10000;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {
                $data['upload_error'] = $this->upload->display_errors();
                log_message('error', 'File upload error: ' . $data['upload_error']);
                var_dump($data);
                exit();
                $this->load->view('nav/katalog_add', $data);
                $this->load->view('layout/footer');
                return;
            } else {
                $upload_data = $this->upload->data();
                $gambar = $upload_data['file_name'];
            }
        } else {
            $gambar = null;
        }

        $data_to_save = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_kategori' => $this->input->post('id_kategori'),
            'harga' => $this->input->post('harga'),
            'jumlah' => $this->input->post('jumlah'),
            'gambar' => $gambar
        );

        if ($this->produk_model->tambah_katalog($data_to_save)) {
            $this->session->set_flashdata('success', 'Data katalog berhasil ditambahkan.');
            redirect('produk/index_katalog');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambah data katalog.');
            redirect('nav/katalog_add');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
