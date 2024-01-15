<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Halaman lampiran</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>Lampiran</h4>
                                </div>
                                <p>Daftar Lampiran</p>
                            </div>
                            <div class="d-flex">

                                <?php if ($data['filter']) : ?>
                                    <a class="btn bg-main text-white mr-2" href="<?= BASEURL ?>/lampiran">back</a>
                                    <select name="jenis_pajak" id="jenis_pajak" class="mx-3" style="border:none; brder-radius:5px;">
                                        <option value="">-- pilih jenis_pajak --</option>
                                        <?php foreach ($data['pajak'] as $pajak) : ?>
                                            <option value="<?= $pajak['nama_pajak'] ?>"><?= $pajak['full_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="date" class="search-date-table form-control">
                                    <input type="date" class="search-date-table2 ml-2 form-control">
                                    <button class="btn bg-main text-white ml-2 text-nowrap" id="btnFilter"><i class="fas fa-filter"></i> Filter</button>
                                <?php else : ?>
                                    <a class="btn bg-main text-white" href="<?= BASEURL ?>/lampiran/filter">filter</a>
                                <?php endif; ?>
                                <input type="text" class="search-data-table form-control ml-2">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama pajak</th>
                                        <th>Lampiran </th>
                                        <th>Tenggat Waktu Pengumpulan</th>
                                        <th>Tujuan</th>
                                        <th>File</th>
                                        <th>Verifikasi</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['notifikasi'] as $index => $row) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= NotifikasiOrm::pajak($row['id_pajak'])['nama_pajak'] ?> </td>
                                            <td><?= NotifikasiOrm::pajak($row['id_pajak'])['lampiran'] ?> </td>
                                            <td><?= $row['deadline'] ?> </td>
                                            <td><?= NotifikasiOrm::cabang($row['id_user'])['nama'] ?> </td>
                                            <td>
                                                <?php if (NotifikasiOrm::hasOneLampiran($row['id'])) : ?>
                                                    <a href="<?= BASEURL ?>/lampiran/download/<?= basename(NotifikasiOrm::hasOneLampiran($row['id'])['file']) ?>" class="btn bg-white ml-2 p-1" data-toggle="tooltip" data-placement="top" title="download file."><i class="far text-success fa-file-excel fa-bigger"></i></a>
                                                <?php else : ?>
                                                    <span class="btn  bg-white text-secondary"><i class="fas fa-file fa-bigger"></i></span>
                                                <?php endif; ?>

                                            </td>
                                            <td class="d-flex">
                                                <?php if (NotifikasiOrm::hasOneLampiran($row['id'])) : ?>
                                                    <form action="<?= BASEURL ?>/lampiran/terima" method="post" class="d-niline">
                                                        <button data-toggle="tooltip" data-placement="top" title="terima lampiran." onclick="return confirm('teirma lampiran?')" name="terima" value="<?= $row['id'] ?>" class="btn btn-primary shadow-none"><i class="fas fa-check"></i></button>
                                                    </form>
                                                    <a href="<?= BASEURL ?>/lampiran/tolak/<?= $row['id'] ?>" data-toggle="tooltip" data-placement="top" title="tolak lampiran." name="tolak" value="<?= $row['id'] ?>" class="ml-2 btn btn-danger shadow-none"><i class="fas fa-times"></i></a>
                                                    <form action="<?= BASEURL ?>/lampiran/reset" method="post" class="d-niline ml-2">
                                                        <button data-toggle="tooltip" data-placement="top" title="reset lampiran." onclick="return confirm('reset lampiran?')" name="reset" value="<?= $row['id'] ?>" title="reset" class="btn btn-warning shadow-none"><i class="fas fa-sync"></i></button>
                                                    </form>
                                                <?php else : ?>
                                                    <span class="badge badge-info">Belum Unggah Lampiran</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['verifikasi'] == '0') : ?>
                                                    <span class="badge badge-secondary">---</span>
                                                <?php elseif ($row['verifikasi'] == '1') : ?>
                                                    <span class="badge badge-light">---</span>
                                                <?php else : ?>
                                                    <?php

                                                    $paragraph = $row['alasan'];
                                                    $words = explode(' ', $paragraph);
                                                    $short_paragraph = implode(' ', array_slice($words, 0, 3)) . '...';
                                                    ?>

                                                    <span onclick="showParagraph('<?= $paragraph ?>')"><?= $short_paragraph ?></span>
                                                    <script>
                                                        function showParagraph(paragraph) {
                                                            alert(paragraph);
                                                        }
                                                    </script>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['verifikasi'] == '0') : ?>
                                                    <span class="badge badge-secondary">Belum Verifikasi</span>
                                                <?php elseif ($row['verifikasi'] == '1') : ?>
                                                    <span class="badge badge-success">Diterima</span>
                                                <?php else : ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php endif; ?>
                                            </td>
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