<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <?php if (isset($data['id'])) : ?>
                <h1>Edit Pengguna</h1>
            <?php else : ?>
                <h1>Tambah Pengguna</h1>
            <?php endif; ?>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>Pengguna</h4>
                                    <a href="<?= BASEURL ?>/pengguna" class="btn bg-main text-white"><i class="fas fa-arrow-left"></i></a>
                                </div>
                                <?php if (isset($data['id'])) : ?>
                                    <p>Edit Pengguna</p>
                                <?php else : ?>
                                    <p>Tambah Pengguna</p>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex">
                                <!-- <input type="text" class="search-data-table form-control"> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (isset($data['id'])) : ?>
                                <form action="<?= BASEURL ?>/pengguna/update" method="post">
                                <?php else : ?>
                                    <form action="<?= BASEURL ?>/pengguna/store" method="post">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="hidden" class="form-control" name="id" value="<?= isset($data['id']) ? $data['edit']['id'] : '' ?>">
                                        <input required type="text" class="form-control" name="nama" value="<?= isset($data['id']) ? $data['edit']['nama'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nrik">NRIK</label>
                                        <input required type="text" class="form-control" name="nrik" value="<?= isset($data['id']) ? $data['edit']['nrik'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input required type="text" class="form-control" name="email" value="<?= isset($data['id']) ? $data['edit']['email'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">No. Telepon (Terdaftar di WhatsApp)</label>
                                        <input required type="text" class="form-control" name="no_hp" value="<?= isset($data['id']) ? $data['edit']['no_hp'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">role</label>
                                        <select name="role" id="role" class="form-control">
                                            <option>admin</option>
                                            <option>akuntansi</option>
                                            <option>cabang</option>
                                            <option>grup</option>
                                        </select>
                                    </div>
                                    <div class="form-grup">
                                        <button type="submit" class="btn bg-main text-white">Simpan</button>
                                    </div>
                                    </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>