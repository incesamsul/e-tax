<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand d-flex flex-column justify-content-center align-items-center my-4">
            <img src="<?= BASEURL ?>/public/assets/img/logo/logo.jpg" alt="" width="150">
            <!-- <a href="index.html">Codebase</a> -->
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard <?= $_SESSION['login']['role'] ?></li>
            <li id="liProfile"><a class="nav-link" href="<?= BASEURL ?>/profile"><i class="far fa-user"></i></i><span>Profil</span></a></li>
            <li id="liBantuan"><a class="nav-link" href="<?= BASEURL ?>/bantuan"><i class="far fa-question-circle"></i> <span>Bantuan</span></a></li>


            <?php if ($_SESSION['login']['role'] == 'admin') : ?>
                <li id="liDashboard"><a href="<?= BASEURL ?>/dashboard" class="nav-link"><i class="far fa-chart-bar"></i></i> <span>Dashboard</span></a></li>
                <li id="liPengguna"><a class="nav-link" href="<?= BASEURL ?>/pengguna"><i class="far  fa-address-card"></i> <span>Pengguna</span></a></li>
            <?php endif; ?>
            <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                <li id="liDashboard"><a href="<?= BASEURL ?>/dashboard" class="nav-link"><i class="far fa-chart-bar"></i></i> <span>Dashboard</span></a></li>
                <li id="liNotifikasi"><a class="nav-link" href="<?= BASEURL ?>/notifikasi"><i class="far  fa-bell"></i> <span>Notifikasi</span></a></li>
                <li id="liLampiran"><a class="nav-link" href="<?= BASEURL ?>/lampiran"><i class="far  fa-file-alt"></i> <span>Lampiran</span></a></li>
                <li id="liLimpahanSalso"><a class="nav-link" href="<?= BASEURL ?>/LimpahanSaldo"><i class="far  fa-file-alt"></i> <span>Limpahan Saldo</span></a></li>
                <li id="liPajak"><a class="nav-link" href="<?= BASEURL ?>/pajak"><i class="far  fa-file-excel"></i> <span>Pajak</span></a></li>
            <?php endif; ?>

            <?php if ($_SESSION['login']['role'] == 'cabang' || $_SESSION['login']['role'] == 'group') : ?>
                <li id="liNotifikasi"><a class="nav-link" href="<?= BASEURL ?>/cabang"><i class="far fa-bell"></i> <span>Notifikasi</span></a></li>
                <li id="liLimpahanSalso"><a class="nav-link" href="<?= BASEURL ?>/LimpahanSaldo"><i class="far  fa-file-alt"></i> <span>Limpahan Saldo</span></a></li>
            <?php endif; ?>

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?= BASEURL ?>/auth/logout" class="btn bg-main text-white btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </aside>
</div>