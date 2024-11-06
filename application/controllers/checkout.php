<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        require_once FCPATH . 'vendor/autoload.php';
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

    public function indexCheckoutAdmin()
    {
        $data['title'] = "Checkout Management Page";

        $data['checkout'] = $this->checkout_model->getAllCheckoutData();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');
        $this->load->view('checkout/checkoutManagement', $data);
        $this->load->view('layout/footer');
    }

    public function editDataCheckout()
    {

        $data['title'] = "Ubah Data Checkout";
        $data['produk'] = $this->produk_model->select($id);

        $this->load->view('layout/header', $data);
        $this->load->view('layout/nav');

        $this->checkout_model->update($id);
        redirect('produk/index_katalog');
    }

    public function afterPayment()
    {
        $data['title'] = "Checkout Page";
        //$this->sendInvoice();

        $id_checkout = $this->session->userdata('id_checkout');

        if (!$id_checkout) {
            redirect('checkout');
            return;
        }

        $buyer = $this->authentication_model->select_by_real_id_query($this->id_akun);
        $checkoutItems = $this->checkout_model->selectAllCheckoutItemsUser($id_checkout);
        $payment_method = $this->checkout_model->getPaymentMethodByCheckoutId($id_checkout);

        $data = [
            'buyer' => $buyer,
            'checkoutItems' => $checkoutItems,
            'payment_method' => $payment_method,
        ];

        $this->load->view('layout/header', $data);
        //$this->load->view('layout/nav');
        $this->load->view('checkout/afterPayment', $data);
        $this->load->view('layout/footer');
    }


    public function konfirmasi()
    {
        if ($this->id_akun && $this->input->server('REQUEST_METHOD') === 'POST') {
            $total_amount = $this->input->post('total_amount');
            $payment_method = $this->input->post('payment_method');

            $cartItems = $this->cart_model->selectAllCartUser($this->id_akun);

            if ($cartItems) {
                $id_checkout = $this->checkout_model->insert($this->id_akun, $total_amount, $payment_method, $cartItems);
                $this->session->set_userdata('id_checkout', $id_checkout);
                redirect('checkout/afterPayment');
            } else {
                redirect('checkout');
            }
        } else {
            redirect('authentication/login');
        }
    }

    public function printInvoiceView()
    {
        $id_checkout = $this->session->userdata('id_checkout');
        $buyer = $this->authentication_model->select_by_real_id_query($this->id_akun);
        $checkoutItems = $this->checkout_model->selectAllCheckoutItemsUser($id_checkout);
        $payment_method = $this->checkout_model->getPaymentMethodByCheckoutId($id_checkout);

        $totalPrice = 0;
        foreach ($checkoutItems as $item) {
            $totalPrice += $item->harga * $item->quantity;
        }
        $tax = $totalPrice * 0.05;
        $finalTotal = $totalPrice + $tax;

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('VertikalDays');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice Details');
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();

        $html = '
        <h1>Invoice</h1>
        <h3>INFORMASI PEMBELI</h3>
        <p><strong>Nama:</strong> ' . htmlspecialchars($buyer->username) . '</p>
        <p><strong>Alamat:</strong> ' . htmlspecialchars($buyer->address) . '</p>
        <p><strong>No HP:</strong> ' . htmlspecialchars($buyer->number) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($buyer->email) . '</p>
        <p><strong>ID Paypal:</strong> ' . htmlspecialchars($buyer->id_paypal) . '</p>

        <h3>RINCIAN PEMBAYARAN</h3>
        <p><strong>Metode Pembayaran:</strong> ' . htmlspecialchars($payment_method->payment_method) . '</p>
        <p><strong>Tanggal Pembayaran:</strong> ' . date('d-m-Y H:i:s') . '</p>

        <h3>RINCIAN PEMBELIAN</h3>
        <table border="1" cellpadding="4">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga / pcs</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($checkoutItems as $item) {
            $html .= '<tr>
                <td>' . htmlspecialchars($item->nama_produk) . '</td>
                <td>' . $item->quantity . '</td>
                <td>Rp ' . number_format($item->harga, 0, ',', '.') . '</td>
                <td>Rp ' . number_format($item->harga * $item->quantity, 0, ',', '.') . '</td>
            </tr>';
        }

        $html .= '<tr>
            <td colspan="3" class="text-right"><strong>Total Harga:</strong></td>
            <td>Rp ' . number_format($totalPrice, 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><strong>Pajak (5%):</strong></td>
            <td>Rp ' . number_format($tax, 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><strong>Total Harga dengan Pajak:</strong></td>
            <td>Rp ' . number_format($finalTotal, 0, ',', '.') . '</td>
        </tr>
    </tbody>
    </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('invoice.pdf', 'I');
    }

    public function printInvoice()
    {
        $id_checkout = $this->session->userdata('id_checkout');
        $buyer = $this->authentication_model->select_by_real_id_query($this->id_akun);
        $checkoutItems = $this->checkout_model->selectAllCheckoutItemsUser($id_checkout);
        $payment_method = $this->checkout_model->getPaymentMethodByCheckoutId($id_checkout);

        $totalPrice = 0;
        foreach ($checkoutItems as $item) {
            $totalPrice += $item->harga * $item->quantity;
        }
        $tax = $totalPrice * 0.05;
        $finalTotal = $totalPrice + $tax;

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('VertikalDays');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice Details');
        $pdf->SetMargins(15, 15, 15);
        $pdf->AddPage();

        $html = '
        <h1>Invoice</h1>
        <h3>INFORMASI PEMBELI</h3>
        <p><strong>Nama:</strong> ' . htmlspecialchars($buyer->username) . '</p>
        <p><strong>Alamat:</strong> ' . htmlspecialchars($buyer->address) . '</p>
        <p><strong>No HP:</strong> ' . htmlspecialchars($buyer->number) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($buyer->email) . '</p>
        <p><strong>ID Paypal:</strong> ' . htmlspecialchars($buyer->id_paypal) . '</p>
    
        <h3>RINCIAN PEMBAYARAN</h3>
        <p><strong>Metode Pembayaran:</strong> ' . htmlspecialchars($payment_method->payment_method) . '</p>
        <p><strong>Tanggal Pembayaran:</strong> ' . date('d-m-Y H:i:s') . '</p>
    
        <h3>RINCIAN PEMBELIAN</h3>
        <table border="1" cellpadding="4">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga / pcs</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($checkoutItems as $item) {
            $html .= '<tr>
                <td>' . htmlspecialchars($item->nama_produk) . '</td>
                <td>' . $item->quantity . '</td>
                <td>Rp ' . number_format($item->harga, 0, ',', '.') . '</td>
                <td>Rp ' . number_format($item->harga * $item->quantity, 0, ',', '.') . '</td>
            </tr>';
        }

        $html .= '<tr>
            <td colspan="3" class="text-right"><strong>Total Harga:</strong></td>
            <td>Rp ' . number_format($totalPrice, 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><strong>Pajak (5%):</strong></td>
            <td>Rp ' . number_format($tax, 0, ',', '.') . '</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><strong>Total Harga dengan Pajak:</strong></td>
            <td>Rp ' . number_format($finalTotal, 0, ',', '.') . '</td>
        </tr>
        </tbody>
        </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdfFilePath = 'D:/Aplikasi/XAMPP/htdocs/WebsiteShopping-Toko-Alat-Kesehatan/pdf_temp/invoice_' . $id_checkout . '.pdf';
        $pdf->Output($pdfFilePath, 'F');
        $this->sendInvoice($buyer->email, $pdfFilePath);
        unlink($pdfFilePath);
    }

    public function sendInvoice($email, $pdfFilePath)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'armenakyantigran642@gmail.com';
            $mail->Password = 'xrce kxnb uhkq qbuq';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('your-email@example.com', 'Vertikal Days');
            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = 'Invoice Pembayaran';
            $mail->Body = 'Terima kasih atas pembelian Anda. Berikut terlampir invoice Anda.';
            $mail->addAttachment($pdfFilePath);

            if ($mail->send()) {
                redirect('authentication');
            };
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
