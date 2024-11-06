<!-- start: Content -->
<div id="content" class="span10">

    <?php
    $nik = $this->session->userdata('username');
    $pengguna = $this->authentication_model->dataPengguna($nik);
    ?>

    <div class="row-fluid sortable">
        <div class="box span11">
            <div class="box-header" data-original-title>
                <h2><i class="icon-gift"></i><span class="break"></span>Katalog</h2>
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
                                <div align="center">Email</div>
                            </th>
                            <th>
                                <div align="center">Total</div>
                            </th>
                            <th>
                                <div align="center">Tanggal</div>
                            </th>
                            <th>
                                <div align="center">Status</div>
                            </th>
                            <th>
                                <div align="center">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i = 1 ?>
                            <?php foreach ($checkout as $row): ?>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo 'Rp ' . number_format($row->total_amount, 0, ',', '.'); ?></td>
                                <td><?php echo $row->checkout_Date; ?></td>
                                <td><?php echo $row->payment_status; ?></td>
                                <td>
                                    <div align="center"><?php echo anchor('checkout/editDataCheckout/', '<i class="icon-edit"></i>', array('class' => 'btn btn-mini btn-success')) ?></div>
                                </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
</div><!--/.fluid-container-->