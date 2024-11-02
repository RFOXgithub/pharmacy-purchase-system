<!-- Start: After Payment Content -->
<div id="content" class="span10">
    <div class="row-fluid sortable">
        <div class="box span11">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon shopping-cart"></i><span class="break"></span>Konfirmasi Pembayaran</h2>
            </div>
            <div class="box-content">
                <div>
                    <div class="col-md-">
                        <h3>INFORMASI PEMBELI</h3>
                        <p><strong>Nama:</strong> <?php echo htmlspecialchars($buyer->username); ?></p>
                        <p><strong>Alamat:</strong> <?php echo htmlspecialchars($buyer->address); ?></p>
                        <p><strong>No HP:</strong> <?php echo htmlspecialchars($buyer->number); ?></p>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <h3>RINCIAN PEMBAYARAN</h3>
                        <p><strong>Metode Pembayaran:</strong> <?php echo htmlspecialchars($payment_method->payment_method); ?></p>
                        <p><strong>Tanggal Pembayaran:</strong> <?php echo date('d-m-Y H:i:s'); ?></p>
                    </div>
                </div>
                <br>
                <h3>RINCIAN PEMBELIAN</h3>
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
                        <?php
                        $totalPrice = 0;
                        foreach ($checkoutItems as $item):
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item->nama_produk); ?></td>
                                <td><?php echo $item->quantity; ?></td>
                                <td><?php echo 'Rp ' . number_format($item->harga, 0, ',', '.'); ?></td>
                                <td><?php echo 'Rp ' . number_format($item->harga * $item->quantity, 0, ',', '.'); ?></td>
                            </tr>
                        <?php
                            $totalPrice += $item->harga * $item->quantity;
                        endforeach;
                        ?>

                        <?php
                        $tax = $totalPrice * 0.05;
                        $finalTotal = $totalPrice + $tax;
                        ?>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total Harga:</strong></td>
                            <td><?php echo 'Rp ' . number_format($totalPrice, 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Pajak (5%):</strong></td>
                            <td><?php echo 'Rp ' . number_format($tax, 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total Harga dengan Pajak:</strong></td>
                            <td><?php echo 'Rp ' . number_format($finalTotal, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-right" style="margin-top: 20px;">
                    <img src="<?php echo base_url('path/to/signature.png'); ?>" alt="Tanda Tangan" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: After Payment Content -->