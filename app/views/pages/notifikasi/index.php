<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Halaman notifikasi <?= isset($data['filtered']) ? $data['filtered'] : '' ?></h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>Notifikasi</h4>
                                    <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                        <a href="<?= BASEURL ?>/notifikasi/create" class="btn bg-main text-white"><i class="fas fa-plus"></i></a>
                                    <?php endif; ?>
                                </div>
                                <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                    <p>Tambah, Edit, dan Hapus Notifikasi</p>
                                <?php else :  ?>
                                    <p>Daftar Notifikasi</p>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <input type="text" class="search-data-table form-control">
                                <?php if ($_SESSION['login']['role'] == 'pajak') : ?>
                                    <button onclick="confirm('kirim email ? ')" class="btn bg-main text-white ml-2 text-nowrap" id="btnSendEmails"><i class="fas fa-envelope"></i> send all</button>
                                    <a href="<?= BASEURL ?>/notifikasi/cabang" class="btn btn-info ml-2">Cabang</a>
                                    <a href="<?= BASEURL ?>/notifikasi/group" class="btn btn-primary ml-2">Group</a>
                                    <a href="<?= BASEURL ?>/notifikasi" class="btn btn-success ml-2">Semua</a>
                                <?php endif; ?>
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
                                        <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                            <th>aksi</th>
                                            <th>
                                                Periksa Semua
                                                <input type="checkbox" id="checkAll">
                                            </th>
                                        <?php endif ?>
                                        <?php if ($_SESSION['login']['role'] == 'cabang') : ?>
                                            <th>Kirim</th>
                                            <th>Alasan</th>
                                            <th>Status</th>
                                        <?php endif ?>
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
                                            <?php if ($_SESSION['login']['role'] == 'akuntansi') : ?>
                                                <td class="d-flex">
                                                    <form action="<?= BASEURL ?>/notifikasi/delete" method="post" class="d-niline">
                                                        <button data-toggle="tooltip" data-placement="top" title="hapus notifikasi." onclick="return confirm('yakin?')" name="delete" value="<?= $row['id'] ?>" class="btn btn-danger shadow-none"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                    <a data-toggle="tooltip" data-placement="top" title="edit notifikasi." href="<?= BASEURL ?>/notifikasi/edit/<?= $row['id'] ?>" class="btn btn-secondary ml-2"><i class="fas fa-pen"></i></a>
                                                    <?php if ($row['email_sended'] == '1') : ?>
                                                        <button data-toggle="tooltip" data-placement="top" title="email telah terkirim." class="btn btn-success shadow-none ml-2"><i class="fas fa-envelope"></i></button>
                                                    <?php else : ?>
                                                        <form action="<?= BASEURL ?>/notifikasi/email" method="post" class="d-niline ml-2">
                                                            <button data-toggle="tooltip" data-placement="top" title="kirim email." onclick="return confirm('kirim email?')" name="email" value="<?= htmlspecialchars(json_encode($row)) ?>" class="btn bg-white shadow-sm"><i class="fas fa-envelope"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <?php
                                                    $message = "Pengisian " . NotifikasiOrm::pajak($row['id_pajak'])['nama_pajak'] . " Cabang.%0A%0ASalam.%0AKepada yang terhormat Bapak/Ibu.%0AKami dari Departemen Perpajakan Korporasi Grup Akuntansi dan Keuangan, dengan ini mohon kepada Bapak/Ibu agar segera melaporkan daftar " . NotifikasiOrm::pajak($row['id_pajak'])['nama_pajak'] . " Cabang ke dalam website E-TAX. Terima kasih.%0A%0ANotes: NIK waiib disi apabila tidak memiliki NPWP.%0A%0ASalam hormat,%0ADept. Perpajakan Korporasi%0AGrup Akuntansi dan Keuangan%0AJl. Suryopranoto No. 8 Lt.6%0AJakarta Pusat (10130)";
                                                    ?>
                                                    <a data-toggle="tooltip" data-placement="top" title="kirim whatsapp." target="_blank" href="https://wa.me/<?= Helpers::convertNoHp(NotifikasiOrm::cabang($row['id_user'])['no_hp']) ?>/?text=<?= $message ?>" class="btn bg-white shadow-sm ml-2">
                                                        <i class="fab fa-whatsapp text-success"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form action="<?= BASEURL ?>/notifikasi/emails" method="post" id="formEmails">
                                                        <input type="checkbox" class="ml-2 checkItem" name="emails[]" value="<?= htmlspecialchars(json_encode($row)) ?>">
                                                    </form>
                                                </td>
                                            <?php endif ?>
                                            <?php if ($_SESSION['login']['role'] == 'cabang') : ?>
                                                <td class="d-flex">
                                                    <?php if (NotifikasiOrm::hasOneLampiran($row['id']) && $row['verifikasi'] != '2') : ?>
                                                        <span class="btn btn-secondary"><i class="fas fa-check"></i></span>
                                                    <?php else : ?>
                                                        <a href="<?= BASEURL ?>/cabang/kirim/<?= $row['id'] ?>" class="btn bg-white ml-2 p-1"><i class="far text-success fa-file-excel fa-bigger"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($row['verifikasi'] == '0') : ?>
                                                        <span class="badge badge-secondary">---</span>
                                                    <?php elseif ($row['verifikasi'] == '1') : ?>
                                                        <span class="badge badge-light">---</span>
                                                    <?php else : ?>
                                                        <?php

                                                        $paragraph = $row['alasan'] ?? '';
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
                                                    <?php if (NotifikasiOrm::hasOneLampiran($row['id'])) : ?>
                                                        <?php if ($row['verifikasi'] == '0') : ?>
                                                            <span class="badge badge-secondary">Belum Verifikasi</span>
                                                        <?php elseif ($row['verifikasi'] == '1') : ?>
                                                            <span class="badge badge-success">Diterima</span>
                                                        <?php else : ?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Belum Unggah</span>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif ?>
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