<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <?php if (isset($data['id'])) : ?>
                <h1>Edit Notifikasi</h1>
            <?php else : ?>
                <h1>Tambah Notifikasi</h1>
            <?php endif; ?>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>Notifikasi</h4>
                                    <a href="<?= BASEURL ?>/notifikasi" class="btn bg-main text-white"><i class="fas fa-arrow-left"></i></a>
                                </div>
                                <?php if (isset($data['id'])) : ?>
                                    <p>Edit Notifikasi</p>
                                <?php else : ?>
                                    <p>Tambah Notifikasi</p>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex">
                                <!-- <input type="text" class="search-data-table form-control"> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (isset($data['id'])) : ?>
                                <form action="<?= BASEURL ?>/notifikasi/update" method="post">
                                <?php else : ?>
                                    <form action="<?= BASEURL ?>/notifikasi/store" method="post">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="nama">nama</label>
                                        <input type="hidden" class="form-control" name="id" value="<?= isset($data['id']) ? $data['edit']['id'] : '' ?>">
                                        <select required name="id_pajak" id="id_pajak" class="form-control">
                                            <option value="">-- pilih --</option>
                                            <?php foreach ($data['pajak'] as $pajak) :  ?>
                                                <option <?= isset($data['id']) ? $data['edit']['id_pajak'] == $pajak['id'] ? 'selected' : '' : '' ?> value="<?= $pajak['id'] ?>"><?= $pajak['nama_pajak'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bulan">bulan</label>
                                        <input required type="month" class="form-control" name="bulan" value="<?= isset($data['id']) ? $data['edit']['bulan'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="deadline">deadline</label>
                                        <input required type="date" class="form-control" name="deadline" value="<?= isset($data['id']) ? $data['edit']['deadline'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="cabang">cabang</label>
                                        <select required name="cabang" id="cabang" class="form-control select2" onchange="updateSelected()">
                                            <option value="">-- pilih --</option>
                                            <option value="select-all">Select All</option>
                                            <option value="deselect-all">Deselect All</option>

                                            <?php foreach ($data['cabang'] as $cabang) : ?>
                                                <option <?= isset($data['id']) ? $data['edit']['id_user'] == $cabang['id'] ? 'selected' : '' : '' ?> value="<?= $cabang['id'] . '-' . $cabang['nama']     ?>"><?= $cabang['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div id="selectedDisplay"></div>
                                    <input type="hidden" name="selectedOptions" id="selectedOptions" value="">

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