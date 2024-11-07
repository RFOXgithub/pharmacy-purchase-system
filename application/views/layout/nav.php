<div id="sidebar-left" class="span3">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <?php
            $nik = $this->session->userdata('username');
            if ($nik) {
                $pengguna = $this->authentication_model->dataPengguna($nik);
            } else {
                $pengguna = null;
            }
            ?>

            <?php if ($pengguna && $pengguna->level == "Admin") : ?>
                <li><a href="<?php echo base_url(); ?>"><i class="icon-home"></i><span class="hidden-tablet"> Beranda</span></a></li>
                <li><a href="<?php echo base_url(); ?>tracking"><i class="icon-search"></i><span class="hidden-tablet"> Pencarian</span></a></li>
                <li><a href="<?php echo base_url(); ?>produk/index_katalog"><i class="icon-gift"></i><span class="hidden-tablet"> Katalog</span></a></li>
                <li><a href="<?php echo base_url(); ?>kategori"><i class="icon-reorder"></i><span class="hidden-tablet"> Kategori</span></a></li>
                <li><a href="<?php echo base_url(); ?>checkout/indexCheckoutAdmin"><i class="icon-shopping-cart"></i><span class="hidden-tablet"> Checkout</span></a></li>
                <li>
                    <a class="dropmenu" href="#"><i class="icon-arrow-right"></i><span class="hidden-tablet"> &nbsp;Pengguna</span></a>
                    <ul>
                        <li><a class="submenu" href="<?php echo base_url(); ?>akses/index_akun"><i class="icon-user"></i><span class="hidden-tablet"> &nbsp; User</span></a></li>
                        <li><a class="submenu" href="<?php echo base_url(); ?>akses"><i class="icon-key"></i><span class="hidden-tablet"> &nbsp; Akses</span></a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="<?php echo base_url(); ?>"><i class="icon-dashboard"></i><span class="hidden-tablet"> Beranda</span></a></li>
                <li><a href="<?php echo base_url(); ?>tracking"><i class="icon-search"></i><span class="hidden-tablet"> Pencarian</span></a></li>
            <?php endif; ?>

        </ul>
    </div>
</div>

<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
</noscript>