<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Bantuan</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-body d-flex align-items-center p-5">
                        <img src="<?= BASEURL ?>/public/assets/img/svg/book.svg" alt="forbidden pages ilustration" width="300">
                        <h4 class="mt-5">Download Manual Book </h4>
                        <p>Download manual book untuk mempelajari cara penggunaan website</p>
                        <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                            <a href="<?= BASEURL ?>/general/download_manual_book/<?= 'akuntansi.pdf' ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="download file."><i class="fas fa-book"></i> Download manual book akuntansi</a>
                        <?php elseif ($_SESSION['login']['role'] == 'cabang') : ?>
                            <a href="<?= BASEURL ?>/general/download_manual_book/<?= 'cabang.pdf' ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="download file."><i class="fas fa-book"></i> Download manual book cabang</a>
                        <?php else : ?>
                            <a href="<?= BASEURL ?>/general/download_manual_book/<?= 'admin.pdf' ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="download file."><i class="fas fa-book"></i> Download manual book admin</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>