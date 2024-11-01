<!-- start: Content -->
<div id="content" class="span10">

    <?php
    $nik = $this->session->userdata('username');
    if ($nik) {
        $pengguna = $this->authentication_model->dataPengguna($nik);
    } else {
        $pengguna = null;
    }
    ?>

    <div class="row-fluid sortable">
        <div class="box span11">
            <div class="box-header" data-original-title>
                <h2><i class="icon-reorder"></i><span class="break"></span><?php echo $subtitle; ?></h2>
                <div class="box-icon">
                    <?php if (!in_array($pengguna->level, ["Operator"])): ?>
                        <a href="<?php echo site_url('kategori/add') ?>" class="halflings-icon white plus" alt="Add Category"></a>
                    <?php endif; ?>
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
                                <div align="center">Nama Kategori</div>
                            </th>
                            <?php if (!in_array($pengguna->level, ["Operator"])): ?>
                                <th>
                                    <div align="center">Aksi</div>
                                </th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="odd gradeX">
                            <?php $i = 1 ?>
                            <?php foreach ($kategori as $row): ?>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row->nama_kategori; ?></td>
                                <?php if (!in_array($pengguna->level, ["Operator"])): ?>
                                    <td>
                                        <div align="center">
                                            <?php echo anchor('kategori/edit/' . $row->id_kategori, '<i class="icon-edit"></i>', array('class' => 'btn btn-mini btn-success')); ?>
                                            <?php echo anchor('kategori/delete/' . $row->id_kategori, '<i class="icon-trash"></i>', array('class' => 'btn btn-mini btn-danger')); ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
</div><!--/.fluid-container-->