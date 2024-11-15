<!-- Start: Checkout Content -->
<div id="content" class="span10">
    <div class="row-fluid sortable">
        <div class="box span11">
            <div class="box-header" data-original-title>
                <h2><i class="icon-shopping-cart"></i><span class="break"></span>Checkout</h2>
            </div>
            <div class="box-content">
                <h3>Ringkasan Pesanan</h3>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga / pcs</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalPrice = 0; ?>
                        <?php foreach ($cartItems as $row): ?>
                            <?php
                            $remainingQuantity = $row->jumlah - $row->quantity;
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row->nama_produk); ?></td>
                                <td><?php echo $row->quantity; ?></td>
                                <td><?php echo 'Rp ' . number_format($row->harga, 0, ',', '.'); ?></td>
                                <td><?php echo 'Rp ' . number_format($row->harga * $row->quantity, 0, ',', '.'); ?></td>
                            </tr>
                            <?php $totalPrice += $row->harga * $row->quantity; ?>
                        <?php endforeach; ?>

                        <?php $tax = $totalPrice * 0.05; ?>
                        <?php $finalTotal = $totalPrice + $tax; ?>
                        <tr>
                            <td colspan="3" align="right"><strong>Total Harga dengan Pajak:</strong></td>
                            <td><?php echo 'Rp ' . number_format($finalTotal, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Metode Pembayaran</h3>
                <form action="<?php echo site_url('checkout/konfirmasi'); ?>" method="post">
                    <input type="hidden" name="total_amount" value="<?php echo $finalTotal; ?>">

                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="Debit/Kredit" required>
                            Debit/Kredit
                        </label>
                        <div class="payment-details" id="debitCreditDetails" style="display: none; margin-top: 10px;">
                            <label>Nama di Kartu</label>
                            <input type="text" name="card_name" class="form-control" placeholder="Nama lengkap">
                            <label>Nomor Kartu</label>
                            <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456">
                            <label>Expiration Date</label>
                            <input type="text" name="card_expiration" class="form-control" placeholder="MM/YY">
                            <label>CVV</label>
                            <input type="text" name="card_cvv" class="form-control" placeholder="123">
                        </div>
                    </div>
                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="Bayar Di Tempat" required>
                            Bayar di Tempat
                        </label>
                    </div>

                    <div style="text-align: right; margin-top: 20px;">
                        <button type="submit" class="btn btn-success">
                            <i class="icon-check"></i> Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="payment_method"]').forEach((input) => {
        input.addEventListener('change', function() {
            const debitCreditDetails = document.getElementById('debitCreditDetails');
            const isDebitCredit = this.value === 'Debit/Kredit';

            debitCreditDetails.style.display = isDebitCredit ? 'block' : 'none';

            document.querySelector('input[name="card_name"]').required = isDebitCredit;
            document.querySelector('input[name="card_number"]').required = isDebitCredit;
            document.querySelector('input[name="card_expiration"]').required = isDebitCredit;
            document.querySelector('input[name="card_cvv"]').required = isDebitCredit;
        });
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        if (paymentMethod === 'Debit/Kredit') {
            const cardName = document.querySelector('input[name="card_name"]').value;
            const cardNumber = document.querySelector('input[name="card_number"]').value;
            const cardExpiration = document.querySelector('input[name="card_expiration"]').value;
            const cardCvv = document.querySelector('input[name="card_cvv"]').value;

            if (!cardName || !cardNumber || !cardExpiration || !cardCvv) {
                alert("Silakan lengkapi detail kartu jika memilih Debit/Kredit.");
                event.preventDefault();
            }
        }
    });
</script>
<!-- End: Checkout Content -->