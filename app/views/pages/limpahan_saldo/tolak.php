<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Halaman Tolak Lampiran</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>Lampiran</h4>
                                    <a href="<?= BASEURL ?>/lampiran" class="btn bg-main text-white"><i class="fas fa-arrow-left"></i></a>
                                </div>
                                <p class="mt-5">Detail Notifikasi</p>
                                <table cellpadding="10">
                                    <tr>
                                        <td>jenis pajak</td>
                                        <td>:</td>
                                        <td><?= NotifikasiOrm::pajak($data['notifikasi']['id_pajak'])['nama_pajak'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran Yang Telah Diunggah</td>
                                        <td>:</td>
                                        <td><?= NotifikasiOrm::pajak($data['notifikasi']['id_pajak'])['lampiran'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tenggat Waktu</td>
                                        <td>:</td>
                                        <td><?= $data['notifikasi']['deadline'] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="d-flex">
                                <input type="text" class="search-data-table form-control">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="<?= BASEURL ?>/lampiran/tolak" method="post">
                                <div class="form-group">
                                    <label for="alasan">alasan</label>
                                    <input required type="hidden" class="form-control" name="id" value="<?= $data['notifikasi']['id'] ?>">
                                    <input required type="text" class="form-control" name="alasan" value="">
                                </div>
                                <div class="form-grup">
                                    <button type="submit" name="btnTolak" class="btn bg-main text-white">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>