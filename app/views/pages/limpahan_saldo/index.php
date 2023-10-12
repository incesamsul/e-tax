<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Upload Limpahan saldo</h1>
        </div>

        <div class="section-body">
            <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-none">
                            <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                                <div>
                                    <div class="d-flex flex-row">
                                        <h4>File</h4>
                                    </div>

                                </div>
                                <div class="d-flex">

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= BASEURL ?>/LimpahanSaldo/upload" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="bulan">bulan</label>
                                        <input type="month" name="bulan" id="bulan" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">file</label>
                                        <input required type="file" class="form-control" name="file">
                                    </div>
                                    <div class="form-grup">
                                        <button type="submit" class="btn bg-main text-white">Simpan</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>List Limpahan </h4>
                                </div>

                            </div>
                            <div class="d-flex">

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>File</th>
                                        <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                            <th>
                                                #
                                            </th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['limpahan_saldo'] as $limpahan) : ?>
                                        <tr>
                                            <td><?= $limpahan['id'] ?></td>
                                            <td><?= $limpahan['bulan'] ?></td>
                                            <td><?= $limpahan['tahun'] ?></td>
                                            <td>
                                                <a href="<?= BASEURL ?>/general/download_limpahan_saldo/<?= basename($limpahan['file']) ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="download file."><i class="fas fa-book"></i> Download </a>
                                            </td>
                                            <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                                <td>
                                                    <form action="<?= BASEURL ?>/LimpahanSaldo/delete" method="post" class="d-niline">
                                                        <button data-toggle="tooltip" data-placement="top" title="hapus ." onclick="return confirm('yakin?')" name="delete" value="<?= $limpahan['id'] ?>" class="btn btn-danger shadow-none"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>