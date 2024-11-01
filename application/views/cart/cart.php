<!-- start: Content -->
<div id="content" class="span10">

    <div class="row-fluid sortable">
        <div class="box span11">
            <div class="box-header" data-original-title>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered table-condensed bootstrap-datatable datatable">
                    <thead>
                        <tr class="gray-table">
                            <th>
                                <div align="center">No</div>
                            </th>
                            <th>
                                <div align="center">Nama Produk</div>
                            </th>
                            <th>
                                <div align="center">Jumlah</div>
                            </th>
                            <th>
                                <div align="center">Harga / pcs</div>
                            </th>
                            <th>
                                <div align="center">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $totalPrice = 0;
                        $taxRate = 0.05;
                        ?>
                        <?php foreach ($cart as $row): ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row->nama_produk; ?></td>
                                <td><?php echo $row->quantity; ?></td>
                                <td><?php echo 'Rp ' . number_format($row->harga, 0, ',', '.'); ?></td>
                                <td>
                                    <div align="center">
                                        <?php echo anchor('cart/incrementQuantity/' . $row->id_cart, '<i class="icon-plus"></i>', array('class' => 'btn btn-mini btn-primary')); ?>
                                        <?php echo anchor('cart/decrementQuantity/' . $row->id_cart, '<i class="icon-minus"></i>', array('class' => 'btn btn-mini btn-warning', 'onclick' => "return confirm('Are you sure to decrease this quantity?')")); ?>
                                        <?php echo anchor('cart/deleteCart/' . $row->id_cart, '<i class="icon-trash"></i>', array('class' => 'btn btn-mini btn-danger', 'onclick' => "return confirm('Are you sure to delete this item?')")); ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $totalPrice += $row->harga * $row->quantity;
                            ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <?php
                        $taxAmount = $totalPrice * $taxRate;
                        $totalWithTax = $totalPrice + $taxAmount;
                        ?>
                        <tr>
                            <td colspan="3" align="right"><strong>Total Harga dengan Pajak:</strong></td>
                            <td colspan="2"><?php echo 'Rp ' . number_format($totalWithTax, 0, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Tombol Pembayaran -->
                <div style="text-align: right;">
                    <a href="<?php echo site_url('checkout/index/' . $row->id_produk); ?>" class="btn btn-success">
                        <i class="icon-credit-card"></i> Bayar
                    </a>
                </div>

            </div>
        </div><!--/span-->
    </div><!--/row-->
</div><!--/.fluid-container-->