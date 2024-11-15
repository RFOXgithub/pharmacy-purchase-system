<!-- start: Content -->
<div id="content" class="span10">


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="icon-gift"></i><span class="break"></span>Katalog Add</h2>
                <div class="box-icon">

                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label">Nama Produk</label>
                            <div class="controls">
                                <input type="text" class="span6" name="nama_produk" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Kategori</label>
                            <div class="controls">
                                <?= form_dropdown('id_kategori', $options, '', 'class="span6" id="selectError" data-rel="chosen"'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Harga</label>
                            <div class="controls">
                                <input type="number" class="span6" name="harga" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Jumlah</label>
                            <div class="controls">
                                <input type="number" class="span6" name="jumlah" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Gambar</label>
                            <div class="controls">
                                <input type="file" class="file span6" name="gambar" />
                                <span style="color: red"><?= form_error('gambar'); ?></span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                            <button type="button" class="btn" onclick="window.history.back()">Batal</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->