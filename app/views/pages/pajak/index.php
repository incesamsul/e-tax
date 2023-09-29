<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Halaman pajak</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none">
                        <div class="card-header d-flex  align-items-start justify-content-between flex-row">
                            <div>
                                <div class="d-flex flex-row">
                                    <h4>pajak</h4>
                                    <a href="<?= BASEURL ?>/pajak/create" class="btn bg-main text-white"><i class="fas fa-plus"></i></a>
                                </div>
                                <p>Tambah, Edit, dan Hapus Pajak</p>
                            </div>
                            <div class="d-flex">
                                <input type="text" class="search-data-table form-control">
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table data-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Pajak</th>
                                        <th>Lampiran</th>
                                        <th>Sampel</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['pajak'] as $index => $row) : ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $row['nama_pajak'] ?></td>
                                            <td><?= $row['lampiran'] ?></td>
                                            <td>
                                                <a href="<?= BASEURL ?>/pajak/download_contoh_lampiran/<?= basename($row['sample']) ?>" class="btn bg-white ml-2 p-1" data-toggle="tooltip" data-placement="top" title="download file."><i class="far text-success fa-file-excel fa-bigger"></i></a>
                                            </td>
                                            <td class="d-flex">
                                                <form action="<?= BASEURL ?>/pajak/delete" method="post" class="d-niline">
                                                    <button onclick="return confirm('yakin?')" name="delete" value="<?= $row['id'] ?>" class="btn btn-danger shadow-none"><i class="fas fa-trash"></i></button>
                                                </form>
                                                <a href="<?= BASEURL ?>/pajak/edit/<?= $row['id'] ?>" class="btn btn-secondary ml-2"><i class="fas fa-pen"></i></a>
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