<div id="content" class="span">
    <?php
    $nik = $this->session->userdata('username');
    $pengguna = $this->authentication_model->dataPengguna($nik);
    ?>

    <div class="row-fluid span10">
        <div class="box span11">
            <div class="box-header">
                <h2><i class="icon-home"></i><span class="break"></span>Detail Produk</h2>
            </div>
            <div class="page-header text-center">
                <h1>Detail Produk Toko Alat Kesehatan</h1>
            </div>
            <div class="produk-container">
                <div class="detail-produk">
                    <img src="<?php echo base_url('/img/produk/' . $product['gambar']); ?>" alt="Product Image" class="img-detail" />
                    <div class="detail-text">
                        <h1>Nama: <?php echo $product['nama_produk']; ?></h1>
                        <h1>Harga: Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?></h1>
                        <button class="btn btn-success" style="margin-top: 10px; width: 150px;"
                            onclick="location.href='<?php echo $this->session->userdata('username') ? site_url('cart/insertCart/' . $product['id_produk']) : site_url('authentication'); ?>'">
                            Buy
                        </button>
                    </div>
                </div>
                <div class="deskripsi-detailproduk2">
                    <div class="devider-left"></div>
                </div>
                <div class="deskripsi-detailproduk">
                    <div class="deskripsi-text">
                        <h1>Deskripsi Produk:</h1>
                        <p><?php echo $product['deskripsi_produk']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>