<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar shadow-none">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg text-secondary"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>

            </form>
            <ul class="navbar-nav navbar-right">
                <?php if ($_SESSION['login']['role'] == 'cabang') : ?>
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="text-secondary nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">-</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <?php foreach ($data['notifikasi'] as $index => $row) : ?>
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-icon bg-primary text-white">
                                            <i class="fas fa-file"></i>
                                        </div>

                                        <div class="dropdown-item-desc">
                                            <?= NotifikasiOrm::pajak($row['id_pajak'])['nama_pajak'] ?>
                                            <div class="time text-primary"><?= NotifikasiOrm::cabang($row['id_user'])['nama'] ?></div>
                                        </div>

                                    </a>
                                <?php endforeach; ?>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">lihat semua<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="<?= BASEURL ?>/public/template/stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block text-secondary"><font color='black'>Hi, <?= $_SESSION['login']['nama'] ?></font></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">User Role : <?= $_SESSION['login']['role'] ?></div>
                        <a href="<?= BASEURL ?>/profile" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= BASEURL ?>/auth/logout" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </nav>