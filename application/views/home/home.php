<div id="content" class="span10">
    <?php
    $nik = $this->session->userdata('username');
    if ($nik) {
        $pengguna = $this->authentication_model->dataPengguna($nik);
    } else {
        $pengguna = null;
    }
    ?>
    <h3>ERROR :
        1. Katalog edit Gambar
        2. Title afterPayment
        3. Sesuaikan Navigasi Admin
    </h3>
    <div class="row-fluid span10">
        <div class="box span11">
            <div class="box-header">
                <h2><i class="icon-home"></i><span class="break"></span>Beranda</h2>
            </div>
            <div class="page-header text-center">
                <h1>Daftar Produk Toko Alat Kesehatan</h1>
            </div>

            <div class="filter-section text-right" style="margin: 10px 45px 20px 10px;">
                <input type="text" id="search-name" placeholder="Cari berdasarkan nama..." onkeyup="filterProducts()">

                <select id="filter-category" onchange="filterProducts()">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori_options as $id => $nama): ?>
                        <option value="<?= $id; ?>"><?= $nama; ?></option>
                    <?php endforeach; ?>
                </select>

                <select id="filter-price" onchange="filterProducts()">
                    <option value="">Pilih Rentang Harga</option>
                    <option value="0-50000">0 - 50.000</option>
                    <option value="51000-100000">51.000 - 100.000</option>
                    <option value="101000-2000000">101.000 - 2.000.000</option>
                    <option value="2010000+">2.000.000+</option>
                </select>
            </div>
            <?php foreach ($product as $row) : ?>
                <div class="span-card statbox product-item" data-name="<?php echo htmlspecialchars($row['nama_produk']); ?>" data-category="<?php echo htmlspecialchars($row['id_kategori']); ?>" data-price="<?php echo htmlspecialchars($row['harga']); ?>" ontablet="span6" ondesktop="span2">
                    <img src="<?php echo base_url('lampiran/' . htmlspecialchars($row['gambar'])); ?>" alt="Gambar Produk" class="span-card-img img-fluid">
                    <h4 class="text-center"><?php echo htmlspecialchars($row['nama_produk']); ?></h4>
                    <h4 class="text-left harga-card"> - Harga: Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></h4>
                    <div class="footer">
                        <button class="btn btn-primary" onclick="location.href='<?php echo site_url('produk/getProductDetails/' . $row['id_produk']); ?>'">View</button>
                        <button class="btn btn-success" onclick="location.href='<?php echo $this->session->userdata('username') ? site_url('cart/insertCart/' . $row['id_produk']) : site_url('authentication'); ?>'">
                            Buy
                        </button>


                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-icon">
                <?php if ($this->session->userdata('username')): ?>
                    <a href="<?php echo site_url('cart'); ?>">
                        <img src="img/cart.png" alt="Keranjang" />
                        <?php if ($totalQuantity > 0): ?>
                            <span class="cart-quantity"><?php echo $totalQuantity; ?></span>
                        <?php endif; ?>
                    </a>
                <?php else: ?>
                    <a href="<?php echo site_url('authentication'); ?>">
                        <img src="img/cart.png" alt="Keranjang" />
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>