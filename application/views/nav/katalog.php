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
                    <?php if (!in_array($pengguna->level, ["Operator"])): ?>
                        <a href="<?php echo site_url('produk/addKatalog') ?>" class="halflings-icon white plus"></a>
                    <?php endif; ?>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <?php if (empty($product)): ?>
                    <div class="alert alert-warning text-center">
                        <strong>Katalog Anda kosong!</strong> Silakan tambahkan produk.
                    </div>
                <?php else: ?>
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
                                    <div align="center">Kategory</div>
                                </th>
                                <th>
                                    <div align="center">Harga</div>
                                </th>
                                <th>
                                    <div align="center">Stock</div>
                                </th>
                                <th>
                                    <div align="center">Gambar</div>
                                </th>
                                <th>
                                    <div align="center">Aksi</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php $i = 1 ?>
                                <?php foreach ($product as $row): ?>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $row->nama_produk; ?></td>
                                    <td><?php echo $row->nama_kategori; ?></td>
                                    <td><?php echo 'Rp ' . number_format($row->harga, 0, ',', '.'); ?></td>
                                    <td><?php echo $row->jumlah; ?></td>
                                    <td>
                                        <div align="center">
                                            <img src="<?php echo base_url(); ?>/<?php echo '/img/produk/' . $row->gambar ?>" style="width: 100px; height: auto;"><br>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center"><?php echo anchor('produk/editProduk/' . $row->id_produk, '<i class="icon-edit"></i>', array('class' => 'btn btn-mini btn-success')) . '  ' . anchor('produk/deleteProduk/' . $row->id_produk, '<i class="icon-trash"></i>', array('class' => 'btn btn-mini btn-danger', 'onclick' => "return confirm('Are you sure to delete this item?')")); ?></div>
                                    </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div><!--/span-->

    </div><!--/row-->
</div><!--/.fluid-container-->