$(function () {


    // var timeout = null;

    // $(document).on('mousemove', function() {
    //     clearTimeout(timeout);
    //     timeout = setTimeout(function() {
    //         console.log('Mouse idle for a minutes');
    //         setTimeout(() => {
    //             Swal.fire({
    //                 position: 'top-end',
    //                 title: "Time's Up",
    //                 icon: 'success',
    //                 showConfirmButton: false,
    //                 timer: 1500
    //             })
    //             setTimeout(() => {
    //                 document.location.href = baseurl + '/Auth/logout';
    //             }, 1500);
    //         }, 3000);
    //     }, (120 * 1000) / 2);
    //     console.log('mouse move');
    // });

    function startCountdown(seconds) {
        let counter = seconds;

        const interval = setInterval(() => {
            // console.log(counter);
            counter++;

            if (counter > 600) {
                clearInterval(interval);
                Swal.fire({
                    position: 'top-end',
                    title: "Time's Up",
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    document.location.href = baseurl + '/Auth/logout';
                }, 1500);
            }
        }, 1000);
    }
    startCountdown(0);


    $('.loader').addClass('hidden');
    //validation script ================================================================================
    let url = $('#base-url').attr('href').split('/');
    let baseurl = url[0] + '//' + url[2] + '/' + url[3];

    $('#password,#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('&#10004;');
            $("#submit-button").prop('disabled', false);
        } else {
            $('#message').html('&#10006;');
            $("#submit-button").prop('disabled', true);
        }
    });

    //upload foto ========================================================================================
    $('#uploadFoto').on('change', function (e) {
        let file = e.target.files[0];

        let fileName = e.target.files[0].name;
        let fileSize = e.target.files[0].size;
        $(this).next('.custom-file-label').html(fileName);

        let validExt = ['jpg', 'png'];
        let fileExt = fileName.split('.').pop();

        if (fileSize > 1000000 && validExt.includes(fileExt)) {
            $('#text-error').html('file terlalu besar');
            $("#submit-button").prop('disabled', true);
        } else if (validExt.includes(fileExt)) {
            $('#text-error').html('');
            $("#submit-button").prop('disabled', false);
        } else {
            $('#image-preview').html('test');
            $('#text-error').html('file harus gambar');
            $("#submit-button").prop('disabled', true);
        }
    })

    //modal tambah teknisi management script ======================================================

    $('#tombol-tambah').on('click', function () {
        $('.modal-title').html('Tambah Data');
        $('#submit-button').html('Tambah Data');
        $('input').val('');
        $('#jabatan').prop('disabled', false);
        $('.password-field').css('display', 'flex');
        $('#form-data').attr('action', baseurl + '/KelolaTeknisi/tambahTeknisi');
    });

    $('.tombol-ubah').on('click', function (e) {
        $('.modal-title').html('Ubah Data');
        $('.password-field').css('display', 'none');
        $('#password').val('');
        $('#password , #uploadFoto').prop('required', false);
        $('#submit-button').html('Ubah Data')
        $('#form-data').attr('action', baseurl + '/KelolaTeknisi/ubahTeknisi');
        const id = $(this).data('id');
        $.ajax({
            url: baseurl + '/KelolaTeknisi/getUbah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#username').val(data.username);
                $('#nama').val(data.nama);
                $('#nohp').val(data.no_hp);
                $('#jabatan option:selected').html(data.jabatan);
                $('#jabatan').prop('disabled', true);
                $('#user_id').val(data.user_id);
                $('#gambar_lama').val(data.foto);

            }
        });
    });

    $('.tombol-hapus').on('click', function (e) {
        e.preventDefault();
        let alamatHapus = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan terhapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = alamatHapus;
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.keluarkan_servisan', function (e) {
        e.preventDefault();
        let alamatKeluarkanServisan = $(this).attr('href');
        Swal.fire({
            title: 'Yakin?',
            text: "Servisan ini akan di keluarkan dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = alamatKeluarkanServisan;
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.kerjakan-servisan', function (e) {
        e.preventDefault();
        let alamatKerjakanServisan = $(this).attr('href');
        Swal.fire({
            title: 'Yakin?',
            text: "Data akan d tambahkan ke list servisanmu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = alamatKerjakanServisan;
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.tanggapi-permintaan', function (e) {
        e.preventDefault();
        let alamatTanggapiPermintaan = $(this).attr('href');
        Swal.fire({
            title: 'Berikan Tanggapan ?',
            text: "Tanggapan akan di kirim ke teknisi yang melakukan request!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terima!',
            cancelButtonText: 'Tolak'
        }).then((result) => {
            if (result.isConfirmed) {

            } else {
                (async () => {

                    const { value: catatan } = await Swal.fire({
                        input: 'textarea',
                        inputLabel: 'Apa yang jadi kendala?',
                        inputPlaceholder: 'ketik di sini gan...',
                        inputAttributes: {
                            'aria-label': 'Type your message here'
                        },
                        showCancelButton: true
                    })

                    if (catatan) {
                        // Swal.fire(catatan);
                        $.ajax({
                            url: alamatSelesaikanServisan,
                            data: { dataId: dataId, kondisiServisan: 'Batal', keterangan: catatan },
                            method: 'post',
                            success: function (data) {
                                if (data == 1) {
                                    Swal.fire('Sevisan Selesai');
                                    document.location.href = baseurl + '/Servisan/servisanSelesai';
                                }
                            }
                        });
                    } else {
                        Swal.fire('isi dlu gan!');
                    }

                })();
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.kembali-kerjakan', function (e) {
        e.preventDefault();
        let alamatKembaliKerjakan = $(this).attr('href');
        Swal.fire({
            title: 'Yakin?',
            text: "Data akan d kembalikan ke list servisanmu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = alamatKembaliKerjakan;
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.alihkan-servisan', function (e) {
        e.preventDefault();
        let dataId = $(this).data('id');
        $.ajax({
            url: baseurl + "/Servisan/getTeknisiPengalihan",
            dataType: 'json',
            success: function (data) {
                let options = {};
                $.map(data, function (o) {
                    options[o.nama] = o.nama;
                });
                (async () => {
                    const { value: teknisi } = await Swal.fire({
                        title: 'Pilih teknisi',
                        input: 'select',
                        inputOptions: options,
                        inputPlaceholder: 'alihkan ke teknisi ...',
                        showCancelButton: true,
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                                if (value === '') {
                                    resolve('Harus pilih teknisi :)')
                                } else {
                                    resolve()
                                }
                            })
                        }
                    })

                    if (teknisi) {
                        $.ajax({
                            url: baseurl + "/Servisan/requestAlihkan",
                            data: { dataId: dataId, teknisi: teknisi },
                            method: 'post',
                            success: function (data) {
                                if (data == 1) {
                                    Swal.fire('Servisan Di alihkan Ke' + teknisi);
                                    document.location.href = baseurl + "/Servisan/prosesPengerjaan";
                                }
                            }
                        });
                    }

                })();
            }
        });

    });

    $('#table1 tbody').on('click', 'tr td a.selesaikan-servisan', function (e) {
        e.preventDefault();
        let alamatSelesaikanServisan = $(this).attr('href');
        let dataId = $(this).data('id');
        Swal.fire({
            title: 'Selesai?',
            text: "Apakah Berhasil atau batal!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Berhasil!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                (async () => {

                    const { value: catatan } = await Swal.fire({
                        input: 'textarea',
                        inputLabel: 'Apa yang di kerja?',
                        inputPlaceholder: 'ketik di sini gan...',
                        inputAttributes: {
                            'aria-label': 'Type your message here'
                        },
                        showCancelButton: true
                    })

                    if (catatan) {
                        // Swal.fire(catatan);
                        $.ajax({
                            url: alamatSelesaikanServisan,
                            data: { dataId: dataId, kondisiServisan: 'Berhasil', keterangan: catatan },
                            method: 'post',
                            success: function (data) {
                                if (data == 1) {
                                    Swal.fire('Sevisan Selesai');
                                    document.location.href = baseurl + '/Servisan/servisanSelesai';
                                }
                            }
                        });

                    } else {
                        Swal.fire('isi dlu gan!');
                    }
                })();
            } else {
                (async () => {

                    const { value: catatan } = await Swal.fire({
                        input: 'textarea',
                        inputLabel: 'Apa yang jadi kendala?',
                        inputPlaceholder: 'ketik di sini gan...',
                        inputAttributes: {
                            'aria-label': 'Type your message here'
                        },
                        showCancelButton: true
                    })

                    if (catatan) {
                        // Swal.fire(catatan);
                        $.ajax({
                            url: alamatSelesaikanServisan,
                            data: { dataId: dataId, kondisiServisan: 'Batal', keterangan: catatan },
                            method: 'post',
                            success: function (data) {
                                if (data == 1) {
                                    Swal.fire('Sevisan Selesai');
                                    document.location.href = baseurl + '/Servisan/servisanSelesai';
                                }
                            }
                        });
                    } else {
                        Swal.fire('isi dlu gan!');
                    }

                })();
            }
        })
    });


    $('#select-laporan-bulanan').on('change', function () {
        let bulan = $(this).val();
        let namaBulan = "";
        switch (bulan) {
            case '01':
                namaBulan = "JANUARI";
                break;
            case '02':
                namaBulan = "FEBRUAI";
                break;
            case '03':
                namaBulan = "MARET";
                break;
            case '04':
                namaBulan = "APRIL";
                break;
            case '05':
                namaBulan = "MEI";
                break;
            case '06':
                namaBulan = "JUNI";
                break;
            case '07':
                namaBulan = "JULI";
                break;
            case '08':
                namaBulan = "AGUSTUS";
                break;
            case '09':
                namaBulan = "SEPTEMBER";
                break;
            case '10':
                namaBulan = "OKTOBER";
                break;
            case '11':
                namaBulan = "NOVEMBER";
                break;
            case '12':
                namaBulan = "DESEMBER";
                break;
        }

        $.ajax({
            url: baseurl + "/Ajax/getAllData",
            method: 'post',
            data: { bulan: bulan },
            dataType: 'json',
            success: function (data) {
                let laporan = '<div class="laporan-header">';
                laporan += '<h6 class="text-center">ALTERGA KOMPUTER</h6>';
                laporan += '<h6 class="text-center">LAPORAN SERVISAN BULANAN</h6>';
                laporan += '<h6 class="text-center">PERIODE ' + namaBulan + ' 2021</h6></div>';
                laporan += '<hr class="m-1"><hr class="m-0">';
                laporan += '<div class="laporan-body">';
                laporan += '<table class="table"><tr>';
                laporan += '<th>KATEGORI SERVISAN</th>';
                laporan += '<th>JUMLAH</th></tr>';
                laporan += '<tr><td>SERVISAN BERHASIL</td>';
                laporan += '<td>' + data.servisanOke + '</td></tr>';
                laporan += '<tr><td>SERVISAN BATAL</td>';
                laporan += '<td>' + data.servisanBatal + '</td></tr>';
                laporan += '<tr><td>SERVISAN KELUAR</td>';
                laporan += '<td>' + data.servisanKeluar + '</td></tr>';
                laporan += '<tr><td>SERVISAN TDAK TERDATA</td>';
                laporan += '<td>' + data.servisanTidakTerdata + '</td></tr>';
                laporan += '<tr><th>TOTAL</th>';
                laporan += '<th>' + data.totalServisan + '</th></tr>';
                $('#laporan-bulanan').html(laporan);
            }
        });
    });


    $('#select-monitor-teknisi').on('change', function () {
        let teknisi = $(this).val();
        $.ajax({
            url: baseurl + "/Ajax/getPekerjaanTeknisiByNama",
            data: { teknisi: teknisi },
            method: "post",
            dataType: "json",
            success: function (data) {
                if (data.length == 0) {
                    $('#table-monitor-teknisi').html('Belum ada Yang di servis');
                } else {
                    $('#table-monitor-teknisi').html('');
                    PintarTablaDinamicamente(data);
                }
            }
        });
    });

    function PintarTablaDinamicamente(data) { //object "data" comes from AJAX response

        var arrColumnas = Object.keys(data[0])
        var columns = []
        //columns must be in JSON format-->{data:'keyToSearchInJSON',title:'columnTitle'}
        for (var i in arrColumnas) {
            columns.push({ data: arrColumnas[i], title: arrColumnas[i] });
        }
        table = $('#table-monitor-teknisi').DataTable({
            dom: "Blfrtip",
            data: data,
            columns: columns,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "bDestroy": true,
        });

    }

    $("#table1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "serverSide": true,
        // "processing": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');

    let action = '<div class="btn-group dropleft action-wrapper">';
    action += '<button type="button" class=" pr-2 btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    action += 'Action</button>';
    action += '<div class="dropdown-menu">';
    action += '<a href="#" class="dropdown-item edit_costumer">';
    action += '<i class="fas fa-edit" data-toggle="tooltip" data-placement="left" title="Edit"></i>Edit User</a>';
    action += '<a href="" class="dropdown-item hapus_costumer" data-toggle="tooltip" data-placement="right" title="hapus"><i class="fas fa-trash"></i>Hapus User</a>';
    action += '<a data-toggle="modal" data-target="#modalCostumer" data-id="" href="" class="dropdown-item print_costumer"><i class="fas fa-print"></i> Print</a></div></div>';

    $('#tableTandaTerima').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,

        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": action
        }],
        // "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //     var index = iDisplayIndex + 1;
        //     $('td:eq(0)', nRow).html(index);
        //     return nRow;
        // },
        "processing": true,
        "serverSide": true,
        "ajax": "../public/ajax/tanda_terima.php",
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableCariServisan_wrapper .col-md-6:eq(0)');

    $('#tableCariServisan').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "createdRow": function (row, data, dataIndex) {
            if (data[12] == "Belum Selesai") {
                $('td', row).css("background-color", "rgba(255,193,7,0.3)");
            } else if (data[12] == "Berhasil") {
                $('td', row).css("background-color", "rgba(40,167,69,0.3)");
            } else if (data[12] == "Batal") {
                $('td', row).css("background-color", "rgba(220,53,69,0.3)");
            } else {
                $('td', row).css("background-color", "rgba(20,63,69,0)");
            }
        },
        "processing": true,
        "serverSide": true,
        "ajax": "../public/ajax/tracking_servisan.php",
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableCariServisan_wrapper .col-md-6:eq(0)');


    $('.tombol-detail').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: baseurl + '/KelolaTeknisi/getUbah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#card-body-detail').html(data.nama);
            }
        });
    });


    $('#merk_laptop').on('change', function () {
        let merkId = $(this).val();
        $.ajax({
            url: baseurl + '/Costumer/getModel',
            data: { merkId: merkId },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                let model = "";
                for (i in data) {
                    model += "<option value =" + data[i].model_id + ">" + data[i].model_laptop + "</option>";
                    $('#model_laptop').html(model);
                }
            }
        });
    });

    $('#jenis_perbaikan').on('change', function () {
        let perbaikanId = $(this).val();
        $.ajax({
            url: baseurl + '/Costumer/getEstimasi',
            data: { perbaikanId: perbaikanId },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                let estimasi = "";
                for (i in data) {
                    estimasi += "<option> Rp. " + data[i].estimasi + "</option>";
                    estimasi += '<option value="custom" id="custom-harga">-- Custom Harga --</option>';
                    $('#estimasi_harga').html(estimasi);
                }
            }
        });
    });

    $('.pagination').addClass('pagination-sm');

    $('.tambah_costumer').on('click', function () {
        $('#modal-footer-print').css('display', 'none');
        if ($('#modal-costumer-size').hasClass("modal-xl")) {
            $('#modal-costumer-size').removeClass("modal-xl")
        }
        $('#modal-costumer-size').addClass('modal-lg');
        $('.print-preview').css('display', 'none');
        $('.form-costumer').css('display', 'block');
        $('.modal-title').html('Tambah Data Costumer');
        $('#tombol-modal-costumer').html('Tambah Data');
        $('#tombol-print-costumer').css('display', 'none');
        $('#tombol-modal-costumer').css('display', 'block');
    });

    $('#table1 tbody').on('click', 'tr td div.btn-group div.dropdown-menu a.print_costumer', function () {
        $('#modal-costumer-size').addClass('modal-xl');
        let costumerId = $(this).data('id');
        // let costumerId;
        // if ($(this).parents('tr').attr('class') == 'odd') {
        //     costumerId = $(this).parents('tr').children('td:eq(0)').text();
        // } else {
        //     costumerId = $(this).parents('tr').prev().children('td:eq(0)').text();
        // }
        printCostumer(costumerId);
    });

    $('#table1 tbody').on('click', 'tr td a.hapus_costumer', function (e) {
        e.preventDefault();
        let alamatHapusCostumer = $(this).attr('href');
        // let alamatHapusCostumer = baseurl + '/Costumer/hapusCostumer/';
        // if ($(this).parents('tr').attr('class') == 'odd') {
        //     alamatHapusCostumer += $(this).parents('tr').children('td:eq(0)').text();
        // } else {
        //     alamatHapusCostumer += $(this).parents('tr').prev().children('td:eq(0)').text();
        // }
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan terhapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = alamatHapusCostumer;
            }
        })
    });

    $('#table1 tbody').on('click', 'tr td a.update_catatan', function (e) {
        e.preventDefault();
        let alamatUpdateCatatan = $(this).attr('href');
        let dataId = $(this).data('id');
        let dataHistory = $(this).data('history');
        (async () => {

            const { value: catatan } = await Swal.fire({
                input: 'textarea',
                inputValue: dataHistory,
                inputLabel: 'Update Catatan',
                inputPlaceholder: 'Ketik catatan Disini...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
            })

            if (catatan) {
                // Swal.fire(catatan);
                $.ajax({
                    url: alamatUpdateCatatan,
                    data: { dataId: dataId, catatan: catatan },
                    method: 'post',
                    success: function (data) {
                        if (data == 1) {
                            Swal.fire('Catatan Terupdate');
                            document.location.href = baseurl + '/Servisan/prosesPengerjaan';
                        }
                    }
                });
            } else {
                Swal.fire('isi dlu gan!');
            }
        })();
    });

    $('#table1 tbody').on('click', 'tr td a.edit_costumer', function (e) {
        e.preventDefault();
        let parentTr = $(this).parents('tr');
        parentTr.css('background', 'rgba(153,156,159,0.5)');
        // parentTr.children('td.merk').prop('contenteditable', true);
        parentTr.children('td.model').prop('contenteditable', true);
        parentTr.children('td.action').children('.action-wrapper').css('display', 'none');
        parentTr.children('td.action').children('.simpan').css('display', 'block');
    });
    $('#table1 tbody').on('click', 'tr td a.simpan-edit', function (e) {
        e.preventDefault();
        let parentTr = $(this).parents('tr');
        let idCostumer = $(this).attr('href');
        let model = parentTr.children('td.model').text();
        parentTr.css('background', 'rgba(153,156,159,0)');
        // parentTr.children('td.merk').prop('contenteditable', false);
        parentTr.children('td.model').prop('contenteditable', false);
        parentTr.children('td.action').children('.action-wrapper').css('display', 'block');
        parentTr.children('td.action').children('.simpan').css('display', 'none');
        $.ajax({
            url: baseurl + '/Costumer/editCostumer',
            method: 'post',
            // dataType: 'json',
            data: { model: model, idCostumer: idCostumer },
            success: function (data) {
                if (data == 1) {
                    Swal.fire({
                        position: 'top-end',
                        title: 'Data telah terupdate',
                        showConfirmButton: false,
                        timer: 800
                    })
                } else {
                    Swal.fire({
                        position: 'top-end',
                        title: 'tidak ada yang berubah',
                        showConfirmButton: false,
                        timer: 800
                    })

                }
            }
        });
    });

    $('#custom_estimasi').css('display', 'none');
    $('select#estimasi_harga').on('change', function () {
        if ($(this).val() == "custom") {
            $(this).remove();
            $('#custom_estimasi').css('display', 'block');
        }
    });

    $('#table1 tbody').on('click', 'tr td.data-costumer-row', function () {
        $('#modal-footer-print').css('display', 'flex');
        let costumerId = $(this).data('id');
        if ($('#modal-costumer-size').hasClass("modal-lg")) {
            $('#modal-costumer-size').removeClass("modal-lg")
        }
        $('#modal-costumer-size').addClass('modal-xl');
        printCostumer(costumerId);
    });

    $('#tableUser tbody').on('click', 'tr td a#tombol-konfirmasi', function (e) {
        e.preventDefault();
        let noHp = $('td#no-hp').text();
        console.log(noHp);
        document.location.href = 'https://api.whatsapp.com/send?phone=628' + noHp.substring(2);
    })

    function printCostumer(costumerId) {
        $('.modal-title').html('Print Preview');
        $('.form-costumer').css('display', 'none');
        $('.print-preview').css('display', 'block');
        $('#tombol-modal-costumer').css('display', 'none');
        $('#tombol-print-costumer').css('display', 'block');
        $('#tombol-print-costumer').html('Print').on('click', function () {
            window.print();
        });
        $('#tombol-kirim-wa').on('click', function (e) {
            e.preventDefault();
            $('.modal-body').parent().append('<div style="opacity:0.5;background:white;width:100%;height:100%;position:absolute;left:0;top:0;display:flex;justify-content:center;align-items:center"><img src="' + baseurl + '/public/img/svg/loading2.svg" width="100"></div>');
            html2canvas(document.querySelector('.modal-body')).then(canvas => {
                // canvas.toBlob(blob => navigator.clipboard.write([new ClipboardItem({
                //     'image/png': blob
                // })]));

                let noHp = $('.modal-body').find('table td#no-hp').text();
                canvas.toBlob(function (blob) {
                    console.log(canvas);
                    navigator.clipboard
                        .write([
                            new ClipboardItem(
                                Object.defineProperty({}, blob.type, {
                                    value: blob,
                                    enumerable: true
                                })
                            )
                        ])
                        .then(function () {
                            setTimeout(() => {
                                document.location.href = 'https://api.whatsapp.com/send?phone=628' + noHp.substring(2);
                            }, 3000);
                        });
                });
            });
        })
        $.ajax({
            url: baseurl + '/Ajax',
            method: 'post',
            data: { costumerId: costumerId },
            success: function (data) {
                $('.print-preview').html(data);
                $('.table-print tr td#qrcode-row').append('<div class="qrcode-wrapper"><div id="qrcode"></div></div>');
                let userInput = costumerId;
                var encoded = enc(userInput.toString());
                // alert(encoded);           // shows encoded string
                // alert(enc(encoded));      // shows the original string again
                createQrCode(encoded);

                function createQrCode(userInput) {
                    var qrcode = new QRCode("qrcode", {
                        text: userInput,
                        width: 126,
                        height: 126,
                        colorDark: "black",
                        logo: baseurl + "/public/img/logo/alterga.svg",
                        colorLight: "white",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            }
        });
    }

    function enc(str) {
        var encoded = "";
        for (i = 0; i < str.length; i++) {
            var a = str.charCodeAt(i);
            var b = a ^ 123; // bitwise XOR with any number, e.g. 123
            encoded = encoded + String.fromCharCode(b);
        }
        return encoded;
    }

    tambahComponent('model');
    tambahComponent('kelengkapan');
    tambahComponent('warna');
    tambahComponent('kondisi_fisik');
    tambahComponent('merk');
    tambahComponent('ukuran');

    function tambahComponent(component) {
        $('.tombol-tambah-' + component).on('click', function () {
            $('#tombol-modal-costumer').prop('disabled', true);
            $('#select-' + component + '-wrapper').css('display', 'none');
            $('#input-' + component + '-wrapper').css('display', 'block');
            $('.tombol-tambah-' + component).css('display', 'none');
            $('.tombol-batal-' + component).css('display', 'block');
            $('#input-laptop-' + component).on('keyup', function () {
                if ($('#input-laptop-' + component).val() == '') {
                    $('.tombol-tambah-' + component).css('display', 'none');
                    $('.tombol-batal-' + component).css('display', 'block');
                    $('.tombol-kirim-' + component).css('display', 'none');
                } else {
                    $('.tombol-kirim-' + component).css('display', 'block');
                    $('.tombol-batal-' + component).css('display', 'none');
                    $('.tombol-tambah-' + component).css('display', 'none');
                }
            });
        });
    }

    tombolBatalComponent('model');
    tombolBatalComponent('kelengkapan');
    tombolBatalComponent('warna');
    tombolBatalComponent('kondisi_fisik');
    tombolBatalComponent('merk');
    tombolBatalComponent('ukuran');

    function tombolBatalComponent(component) {
        $('.tombol-batal-' + component).on('click', function () {
            $('#tombol-modal-costumer').prop('disabled', false);
            $('#select-' + component + '-wrapper').css('display', 'block');
            $('#input-' + component + '-wrapper').css('display', 'none');
            if ($('#select-' + component + '-wrapper').css('display') == 'block') {
                $('.tombol-tambah-' + component).css('display', 'block');
                $('.tombol-batal-' + component).css('display', 'none');
            }
        });
    }

    $('.tombol-kirim-warna').on('click', function () {
        kirimComponent('warna');
    })

    $('.tombol-kirim-kelengkapan').on('click', function () {
        kirimComponent('kelengkapan');
    });

    $('.tombol-kirim-kondisi_fisik').on('click', function () {
        kirimComponent('kondisi_fisik');
    });

    $('.tombol-kirim-merk').on('click', function () {
        kirimComponent('merk');
    });

    $('.tombol-kirim-ukuran').on('click', function () {
        kirimComponent('ukuran');
    });

    function kirimComponent(component) {
        key = $('#input-laptop-' + component).val();
        $.ajax({
            url: baseurl + '/Costumer/tambah' + component,
            data: { key: key },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                let componentId = Object.values(data)[0];
                let componentValue = Object.values(data)[1];
                // console.log(componentId);
                // console.log(componentValue);
                if (data != false) {
                    Swal.fire(
                        'Berhasil',
                        component + ' laptop ditambahkan',
                        'success'
                    );
                    $('#select-' + component + '-wrapper').css('display', 'block');
                    $('#input-' + component + '-wrapper').css('display', 'none');
                    $('.tombol-tambah-' + component).css('display', 'block');
                    $('.tombol-kirim-' + component).css('display', 'none');
                    // $('#model_laptop option').val(data.model_id).prop('selected', true);
                    // $('#model_laptop option:selected').html(data.model_laptop);
                    let appendNewOption = '<option value="' + componentId + '">' + componentValue + '</option>';
                    $('#' + component + '_laptop option:selected').parent().append(appendNewOption);
                    $('#' + component + '_laptop option:last').attr("selected", "selected");
                    $('#tombol-modal-costumer').prop('disabled', false);
                } else {
                    Swal.fire(
                        'Gagal',
                        component + ' laptop sudah ada',
                        'error'
                    );
                    $('#select-' + component + '-wrapper').css('display', 'block');
                    $('#input-' + component + '-wrapper').css('display', 'none');
                    $('.tombol-tambah-' + component).css('display', 'block');
                    $('.tombol-kirim-' + component).css('display', 'none');
                }
            }
        })
    }



    $('.tombol-kirim-model').on('click', function () {
        let merkId = $('#merk_laptop').val();
        let newModel = $('#input-laptop-model').val();
        $.ajax({
            url: baseurl + '/Costumer/tambahModel',
            data: { merkId: merkId, newModel: newModel },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (!data.model_laptop == "") {
                    Swal.fire(
                        'Berhasil',
                        'model laptop ditambahkan',
                        'success'
                    );
                    $('#select-model-wrapper').css('display', 'block');
                    $('#input-model-wrapper').css('display', 'none');
                    $('.tombol-tambah-model').css('display', 'block');
                    $('.tombol-kirim-model').css('display', 'none');
                    // $('#model_laptop option').val(data.model_id).prop('selected', true);
                    // $('#model_laptop option:selected').html(data.model_laptop);
                    let appendNewOption = '<option value="' + data.model_id + '">' + data.model_laptop + '</option>';
                    $('#model_laptop option:selected').parent().append(appendNewOption);
                    $('#model_laptop option:last').attr("selected", "selected");
                    $('#tombol-modal-costumer').prop('disabled', false);
                } else {
                    Swal.fire(
                        'Gagal',
                        'model laptop sudah ada',
                        'error'
                    );
                    $('#select-model-wrapper').css('display', 'block');
                    $('#input-model-wrapper').css('display', 'none');
                    $('.tombol-tambah-model').css('display', 'block');
                    $('.tombol-kirim-model').css('display', 'none');
                }
            }
        });
    });



    $.ajax({
        url: baseurl + "/Ajax/getStatisticData",
        dataType: "json",
        async: false,
        success: function (data) {
            let servisanOke = [];
            let servisanBatal = [];
            let servisanKeluar = [];
            let servisanTidakTerdata = [];
            let totalServisan = [];
            for (i in data) {
                servisanOke.push(data[i].servisanOke);
                servisanBatal.push(data[i].servisanBatal);
                servisanKeluar.push(data[i].servisanKeluar);
                totalServisan.push(data[i].totalServisan);
                servisanTidakTerdata.push(data[i].servisanTidakTerdata);
                // eslint-disable-next-line no-unused-vars
            }
        }
    });


    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    $.ajax({
        url: baseurl + "/Ajax/getStatisticData",
        dataType: "json",
        async: false,
        success: function (data) {
            let servisanOke = [];
            let servisanBatal = [];
            let servisanKeluar = [];
            let servisanTidakTerdata = [];
            let totalServisan = [];
            for (i in data) {
                servisanOke.push(data[i].servisanOke);
                servisanBatal.push(data[i].servisanBatal);
                servisanKeluar.push(data[i].servisanKeluar);
                totalServisan.push(data[i].totalServisan);
                servisanTidakTerdata.push(data[i].servisanTidakTerdata);

                var $salesChart = $('#sales-chart')
                // eslint-disable-next-line no-unused-vars
                var salesChart = new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL'],
                        datasets: [{
                            backgroundColor: '#28A745',
                            borderColor: '#28A745',
                            data: servisanOke
                        },
                        {
                            backgroundColor: '#DC3545',
                            borderColor: '#DC3545',
                            data: servisanBatal
                        },
                        {
                            backgroundColor: '#343A40',
                            borderColor: '#343A40',
                            data: servisanKeluar
                        },
                        {
                            backgroundColor: '#FFC107',
                            borderColor: '#FFC107',
                            data: totalServisan
                        },
                        {
                            backgroundColor: '#6C757D',
                            borderColor: '#6C757D',
                            data: servisanTidakTerdata
                        }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            }
        }
    });

    // line chart ----------------------------------------------------------------

    $.ajax({
        url: baseurl + "/Ajax/getStatisticData",
        dataType: "json",
        async: false,
        success: function (data) {
            let servisanOke = [];
            let servisanBatal = [];
            let servisanKeluar = [];
            let servisanTidakTerdata = [];
            let totalServisan = [];
            for (i in data) {
                servisanOke.push(data[i].servisanOke);
                servisanBatal.push(data[i].servisanBatal);
                servisanKeluar.push(data[i].servisanKeluar);
                totalServisan.push(data[i].totalServisan);
                servisanTidakTerdata.push(data[i].servisanTidakTerdata);
                var $visitorsChart = $('#stats-servisan')
                // eslint-disable-next-line no-unused-vars
                var visitorsChart = new Chart($visitorsChart, {
                    data: {
                        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUNE', 'JULY'],
                        datasets: [{
                            type: 'line',
                            data: servisanOke,
                            backgroundColor: 'transparent',
                            borderColor: '#28A745',
                            pointBorderColor: '#28A745',
                            pointBackgroundColor: '#28A745',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        {
                            type: 'line',
                            data: servisanKeluar,
                            backgroundColor: 'transparent',
                            borderColor: '#343A40',
                            pointBorderColor: '#343A40',
                            pointBackgroundColor: '#343A40',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        {
                            type: 'line',
                            data: totalServisan,
                            backgroundColor: 'transparent',
                            borderColor: '#FFC107',
                            pointBorderColor: '#FFC107',
                            pointBackgroundColor: '#FFC107',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        {
                            type: 'line',
                            data: servisanBatal,
                            backgroundColor: 'tansparent',
                            borderColor: '#DC3545',
                            pointBorderColor: '#DC3545',
                            pointBackgroundColor: '#DC3545',
                            fill: false
                            // pointHoverBackgroundColor: '#ced4da',
                            // pointHoverBorderColor    : '#ced4da'
                        }, {
                            type: 'line',
                            data: servisanTidakTerdata,
                            backgroundColor: 'transparent',
                            borderColor: '#6C757D',
                            pointBorderColor: '#6C757D',
                            pointBackgroundColor: '#6C757D',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            mode: mode,
                            intersect: intersect
                        },
                        hover: {
                            mode: mode,
                            intersect: intersect
                        },
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                // display: false,
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    suggestedMax: 200
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            }
        }
    });

    // menghitung perkembangan servisan ----------------------------------------------------------------------

    $.ajax({
        url: baseurl + '/Ajax/perkembanganBulanan',
        success: function (data) {
            if (data > 0) {
                let perkembanganBulanan = '<span class="text-success">';
                perkembanganBulanan += '<i class="fas fa-arrow-up"></i> ' + data + '%</span>';
                perkembanganBulanan += '<span class="text-muted">Dibanding dengan bulan lalu</span>';
                $('.perkembangan-bulanan').html(perkembanganBulanan);
            } else {
                let perkembanganBulanan = '<span class="text-danger">';
                perkembanganBulanan += '<i class="fas fa-arrow-down"></i> ' + data * -1 + '%</span>';
                perkembanganBulanan += '<span class="text-muted">Dibanding dengan bulan lalu</span>';
                $('.perkembangan-bulanan').html(perkembanganBulanan);
            }
        }
    });

    // pilih user ==============================================================================================
    $('#list-user').on('click', function () {
        $('.select2').select2();
        $.ajax({
            url: baseurl + '/Costumer/getAllCostumer',
            dataType: 'json',
            success: function (data) {
                let option = "";
                for (i in data) {
                    option += '<option value="' + data[i].costumer_id + '">' + data[i].nama + '</option>';
                }
                (async () => {
                    const { value: formValues } = await Swal.fire({
                        title: 'Pilih Costumer',
                        confirmButtonText: 'Pilih',
                        showCancelButton: true,
                        html: '<div class="form-group text-left">' +
                            '<select id="user" class="form-control select2 form-control-sm">' +
                            option +
                            '</select>' +
                            '</div>',
                        focusConfirm: false,
                        onOpen: function () {
                            $('.select2').select2();
                        },
                        preConfirm: () => ({
                            user_id: $('#user').val(),
                        })
                    })

                    if (formValues) {
                        $.ajax({
                            url: baseurl + '/Costumer/getCostumerById',
                            data: { id: formValues.user_id },
                            method: 'post',
                            dataType: 'json',
                            success: function (data) {
                                $('#nama').val(data.nama);
                                $('#nohp').val(data.no_hp);
                                $('#alamat').val(data.alamat);
                            }
                        });
                    }
                })()
            }
        });
    });


});