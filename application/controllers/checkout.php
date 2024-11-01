<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('checkout_model');
        $this->load->model('cart_model');
        $this->load->model('authentication_model');

        $input = $this->session->userdata('username');
        $pengguna = $this->authentication_model->dataPengguna($input);
        $this->id_akun = $pengguna ? $pengguna->id_akun : null;
    }

    public function index()
    {
        $data['title'] = "Checkout Page";

        if ($this->id_akun) {
            $data['cartItems'] = $this->cart_model->selectAllCartUser($this->id_akun);
        } else {
            redirect('authentication');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('checkout/checkout', $data);
        $this->load->view('layout/footer');
    }

    public function afterPayment()
    {
        $data['title'] = "Checkout Page";

        if ($this->id_akun) {
            $data['cartItems'] = $this->cart_model->selectAllCartUser($this->id_akun);
        } else {
            redirect('authentication');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('checkout/afterPayment', $data);
        $this->load->view('layout/footer');
    }

    public function konfirmasi($total_amount, $payment_status, $payment_method)
    {
        if ($this->id_akun) {
            $data['cartItems'] = $this->cart_model->selectAllCartUser($this->id_akun);
            $this->checkout_model->insert($this->id_akun, $total_amount, $payment_status, $payment_method);
        }
        redirect('checkout/afterPayment');

        #divider

        if ($this->id_akun) {
            $existingCartItem = $this->cart_model->getCartItem($this->id_akun, $id_produk);

            if ($existingCartItem) {
                $newQuantity = $existingCartItem->quantity + 1;
                $this->cart_model->updateCartQuantity($existingCartItem->id_cart, $newQuantity);
            } else {
                $this->cart_model->insert($this->id_akun, $id_produk, 1);
            }
        }
        redirect('produk');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
