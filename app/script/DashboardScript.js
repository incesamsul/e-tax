$('.btn-filter').on('click', function (e) {
    e.preventDefault();
    let bulan = $('#bulan').val();
    let tahun = $('#tahun').val();
    let filterBulan = tahun + '-' + bulan;
    let jenis = $('#jenis_pajak').val();
    document.location.href = '/e-tax/dashboard/' + filterBulan + '/' + jenis;
})