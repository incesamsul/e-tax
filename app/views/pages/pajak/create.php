<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <?php if (isset($data['id'])) : ?>
                <h1>Edit Pajak</h1>
            <?php else : ?>
                <h1>Tambah Pajak</h1>
            <?php endif; ?>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>pajak</h4>
                                    <a href="<?= BASEURL ?>/pajak" class="btn bg-main text-white"><i class="fas fa-arrow-left"></i></a>
                                </div>
                                <?php if (isset($data['id'])) : ?>
                                    <p>Edit Pajak</p>
                                <?php else : ?>
                                    <p>Tambah Pajak</p>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex">
                                <!-- <input type="text" class="search-data-table form-control"> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if (isset($data['id'])) : ?>
                                <form enctype="multipart/form-data" action="<?= BASEURL ?>/pajak/update" method="post">
                                <?php else : ?>
                                    <form enctype="multipart/form-data" action="<?= BASEURL ?>/pajak/store" method="post">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="nama_pajak">Nama Pajak</label>
                                        <input type="hidden" class="form-control" name="id" value="<?= isset($data['id']) ? $data['edit']['id'] : '' ?>">
                                        <input required type="text" class="form-control" name="nama_pajak" value="<?= isset($data['id']) ? $data['edit']['nama_pajak'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lampiran">Lampiran</label>
                                        <input required type="text" class="form-control" name="lampiran" value="<?= isset($data['id']) ? $data['edit']['lampiran'] : '' ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sample">Sampel</label>
                                        <input <?= $data['id'] ? '' : 'required' ?> type="file" class="form-control" name="sample" value="<?= isset($data['id']) ? $data['edit']['sample'] : '' ?>">
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