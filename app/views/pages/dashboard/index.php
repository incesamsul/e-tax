<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-none">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Filter</h5>
                            <p><small>Filter berdasarkan bulan dan tahun</small></p>
                            <form class="row" action="<?= BASEURL ?>/dashboard">
                                <?php
                                $dataBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                $dataTahun = ['2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'];
                                ?>
                                <div class="form-group col-sm-3">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">-- pilih bulan --</option>
                                        <?php foreach ($dataBulan as $index => $value) : ?>
                                            <option value="<?= $index + 1 ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">-- pilih tahun --</option>
                                        <?php foreach ($dataTahun as $index => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12    ">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-none bg-secondary">
                            <i class="far fa-file-alt"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending</h4>
                            </div>
                            <div class="card-body">
                                <?= $data['pending'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-none bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Cabang</h4>
                            </div>
                            <div class="card-body">
                                <?= count($data['cabang']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-none bg-danger">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Cabang Belum kumpul</h4>
                            </div>
                            <div class="card-body">
                                <?= $data['declined'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-icon shadow-none bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Cabang Sudah kumpul</h4>
                            </div>
                            <div class="card-body">
                                <?= $data['declined'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
</div>