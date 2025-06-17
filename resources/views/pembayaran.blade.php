@extends('layouts.app')

@section('title', 'Pembayaran')
@section('content')
<style>
    .select2-selection__rendered {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
</style>
<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     <h4>Menu Pembayaran</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item active">Pembayaran</li>
                     </ol>
                 </div>
                 <button class="btn btn-danger form-control back" style="display:none;"><span class='fa fa-backward'></span>&nbsp;<b>Kembali</b></button>
                 <button class="btn btn-primary form-control add" ><span class="fa fa-plus"></span>&nbsp;<b>Tambah Data</b></button>
             </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-12" id='front'>
                <div class="card">
                    <div class="card-body">
                        <table id="grid_pembayaran" class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>WR ID</b></th>
                                    <th><b>NPWR</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Tanggal Pembayaran</b></th>
                                    <th><b>Jumlah</b></th>
                                    <th><b>Keterangan</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-12" id='form-input' style='display:none'>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Input Pembayaran</h4>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="npwr">NPWR</label>
                                        <select class="form-control" id="npwr" style="width: 100%">
                                            <option value="">Pilih NPWR</option>
                                        </select>
                                        <input type="hidden" class="form-control" id="id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="tgl_pembayaran">Tanggal Pembayaran</label>
                                        <input type="text" id='tgl_pembayaran' class="form-control datepicker" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-12" id='front'>
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="grid_det_pembayaran" class="display responsive" width="100%" style='font-size:11px;'>
                                                <thead>
                                                    <tr>
                                                        <th><b>Penetapan ID</b></th>
                                                        <th><b>No.</b></th>
                                                        <th><b>No.Seri</b></th>
                                                        <th><b>Bulan</b></th>
                                                        <th><b>Tahun</b></th>
                                                        <th><b>Tagihan</b></th>
                                                        <th><b>Sub Total Pembayaran</b></th>
                                                        <th><b>Action</b></th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end mt-3">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="jumlah">Total Pembayaran</label>
                                        <input type="text" disabled class="form-control text-end" id="jumlah" placeholder="Jumlah" value="0.00" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <button class="btn btn-success form-control save"><span class='far fa-save fa-lg'></span>&nbsp;<b>Simpan Data</b></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            "autoclose": true
        })
        .on('changeDate', function(ev) {
            $(this).datepicker('hide');
        });
        $("#grid_det_pembayaran").DataTable({
            // processing: true,
            // serverSide: true,
            // ajax: "{{ url('pembayaran/data') }}",
            responsive: true,
            columns: [
                { data: 'penetapan_id', name: 'penetapan_id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'no_seri', name: 'no_seri' },
                { data: 'bulan', name: 'bulan' },
                { data: 'tahun', name: 'tahun' },
                { data: 'tagihan', name: 'tagihan' },
                { data: 'total_pembayaran', name: 'total_pembayaran' ,
                    render: function(data, type, row) {
                        return `<input type="number" class="form-control input-total" data-id="${row.penetapan_id}" 
                            value="${parseFloat(data).toFixed(2)}" 
                            oninput="formatNumber(this)" 
                            onchange="formatNumber(this)" 
                            step="0.01">`;
                    }
                },
                { data: 'action', name: 'action', searchable: false }
            ]
        });
        $("#grid_det_pembayaran").on("click", ".bayar", function(e) {
            e.preventDefault();
            let penetapan_id = $(this).data("id");
            let row = $(this).closest("tr");
            let bulan = row.find("td:eq(2)").text();
            let tahun = row.find("td:eq(3)").text();
            let tagihan = row.find("td:eq(4)").text();
            let total_pembayaran = row.find("input.input-total").val();
            console.log("Penetapan ID: " + penetapan_id);
            console.log("Bulan: " + bulan);
            console.log("Tahun: " + tahun);
            console.log("Tagihan: " + tagihan);
            console.log("Total Pembayaran: " + total_pembayaran);
            row.find("input.input-total").val(tagihan);
            let total = 0;
            $(".input-total").each(function() {
                let value = angka($(this).val()) || 0;
                total += value;
            });
            
            // Format total dan masukkan ke input jumlah
            $("#jumlah").val(number_format(total,2,'.',','));
        });
        $("#grid_det_pembayaran").on("input keypress change", ".input-total", function() {
            let total = 0;
            let row = $(this).closest("tr");
            let tagihan = row.find("td:eq(4)").text();
            
            // console.log('tagihan' +tagihan);
            
            if(angka(tagihan) < angka($(this).val())){
                Swal.fire('Info', 'Total pembayaran Rp. ' + $(this).val() + ' melebihi nilai tagihan sebesar Rp. ' + tagihan , 'info');
            }
            $(".input-total").each(function() {
                let value = angka($(this).val()) || 0;
                total += value;
            });
            
            // Format total dan masukkan ke input jumlah
            $("#jumlah").val(number_format(total,2,'.',','));
        });
                
        $('#grid_pembayaran').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('pembayaran/data') }}",
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'wr_id', name: 'wr_id' ,visible: false, searchable: false},
                { data: 'npwr', name: 'npwr' },
                { data: 'nama', name: 'nama' },
                { data: 'tgl_pembayaran', name: 'tgl_pembayaran',
                    render: function(data, type, row) {
                        return formatDate(data);
                    } 
                },
                { data: 'jumlah', name: 'jumlah',
                    render: function(data, type, row) {
                        console.log(data);
                        return number_format(data,2,'.',','); 
                    }
                },
                { data: 'keterangan', name: 'keterangan' },
                { data: 'action', name: 'action', searchable: false }
            ]
        });
        $(".add").on("click",function(e){
            document.getElementById("id").value = "";
            $("#npwr").val("").trigger("change");
            document.getElementById("tgl_pembayaran").value = "";
            document.getElementById("jumlah").value = "0.00";
            document.getElementById("keterangan").value = "";
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });
        $(".back").on("click",function(e){
            document.getElementById("id").value = "";
            $("#npwr").val("").trigger("change");
            document.getElementById("tgl_pembayaran").value = "";
            document.getElementById("jumlah").value = "0.00";
            document.getElementById("keterangan").value = "";
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $('#npwr').select2({
            placeholder: 'Pilih NPWR atau Nama yang tertera pada NPWR',
            minimumInputLength: 2,
            language: {
                inputTooShort: function(args) {
                    return "Silakan ketik minimal 2 huruf untuk meload data";
                }
            },
            templateSelection: function (data) {
                if (!data.id) return data.text;
                return $('<span title="' + data.text + '">' + data.text + '</span>');
            },
            templateResult: function (data) {
                if (!data.id) return data.text;
                return $('<span title="' + data.text + '">' + data.text + '</span>');
            },
            ajax: {
                url: "{{ url('pembayaran/autocomplete-npwr') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $("#npwr").on("change", function(e) {
            let id = $(this).val();
            if (id) {
                $("#grid_det_pembayaran").DataTable().clear().destroy();
                $("#grid_det_pembayaran").DataTable({
                    processing: true,
                    serverSide: true,   
                    responsive: true,
                    ajax: {
                        url: "{{ url('pembayaran/dataDet') }}",
                        type: "GET",
                        data: function(d) {
                            d.wr_id = id;
                            d.idx = document.getElementById("id").value;
                            d._token = $('meta[name="csrf-token"]').attr('content');
                        }
                    },
                    columns: [
                        { data: 'penetapan_id', name: 'penetapan_id', visible: false, searchable: false },
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                        { data: 'no_seri', name: 'no_seri' },
                        { data: 'bulan', name: 'bulan',
                            render: function(data, type, row) {
                                const namaBulan = [
                                    'Januari', 'Februari', 'Maret', 'April', 
                                    'Mei', 'Juni', 'Juli', 'Agustus',
                                    'September', 'Oktober', 'November', 'Desember'
                                ];
                                return namaBulan[parseInt(data) - 1] || data;
                            }
                        },
                        { data: 'tahun', name: 'tahun' },
                        { data: 'tagihan', name: 'tagihan',
                            render: function(data, type, row) {
                                console.log(data);
                                return number_format(data,2,'.',','); 
                            }
                        },
                        { data: 'total_pembayaran', name: 'total_pembayaran',
                            render: function(data, type, row) {
                                return `<input type="text" class="form-control input-total" data-id="${row.penetapan_id}" 
                                    oninput="return(currencyFormat(this,',','.',event))" 
                                    onchange="return(currencyFormat(this,',','.',event))" 
                                    onkeypress="return(currencyFormat(this,',','.',event))" 
                                    value="${number_format(data,2,'.',',')}">`;
                            }
                        },
                        { data: 'action', name: 'action', searchable: false }
                    ]
                });
            }
        });
        // Fungsi untuk menyimpan data pembayaran
        $(".save").on("click", function(e) {
            e.preventDefault();
            
            let id = $("#id").val();
            let npwr = $("#npwr").val();
            let tgl_pembayaran = $("#tgl_pembayaran").val();
            let jumlah = $("#jumlah").val().replace(/,/g, '');
            let keterangan = $("#keterangan").val();
            
            // Validasi input dasar
            if (!npwr) {
                Swal.fire('Error', 'NPWR harus dipilih', 'error');
                return;
            }
            
            if (!tgl_pembayaran) {
                Swal.fire('Error', 'Tanggal pembayaran harus diisi', 'error');
                return;
            }
            
            if (parseFloat(jumlah) <= 0) {
                Swal.fire('Error', 'Total pembayaran harus lebih dari 0', 'error');
                return;
            }
            
            // Kumpulkan detail pembayaran dari grid
            let details = [];
            $('.input-total').each(function() {
                let penetapan_id = $(this).data('id');
                let total_pembayaran = angka($(this).val());
                
                if (parseFloat(total_pembayaran) > 0) {
                    details.push({
                        penetapan_id: penetapan_id,
                        total_pembayaran: total_pembayaran
                    });
                }
            });
            
            if (details.length === 0) {
                Swal.fire('Error', 'Minimal satu detail pembayaran harus diisi', 'error');
                return;
            }
            
            // Kirim data ke server dengan Ajax
            $.ajax({
                url: "{{ url('pembayaran/save-data') }}",
                type: "POST",
                data: {
                    id: id,
                    wr_id: npwr,
                    tgl_pembayaran: tgl_pembayaran,
                    jumlah: jumlah,
                    keterangan: keterangan,
                    details: details,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Mohon tunggu',
                        html: 'Sedang memproses data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();
                    if (response.success) {
                        Swal.fire('Sukses', 'Data pembayaran berhasil disimpan', 'success');
                        // Reset form
                        $(".back").trigger("click");
                        // Reload data tabel utama
                        $('#grid_pembayaran').DataTable().ajax.reload();
                    } else {
                        Swal.fire('Error', response.message || 'Terjadi kesalahan saat menyimpan data', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        });
        $("#grid_pembayaran").on("click",".cetak-stbp",function(e){
            e.preventDefault();
            var id = $(this).data('id');
            window.open("{{ route('pembayaran.cetak_stbp') }}?id=" + id, "_blank");
        });
        $("#grid_pembayaran").on("click",".delete",function(e){
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('pembayaran/delete-data') }}",
                        type: "POST",
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Sukses', 'Data berhasil dihapus', 'success');
                                $('#grid_pembayaran').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Error', response.message || 'Terjadi kesalahan saat menghapus data', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            let errorMessage = 'Terjadi kesalahan saat menghapus data';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            }); 
        });
        $("#grid_pembayaran").on("click",".edit",function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('pembayaran/dataById') }}",
                type: "GET",
                data: {
                    id: id
                },
                success: function(response) {
                    document.getElementById("id").value = response.id;
                    let newOption = new Option(response.text, response.wr_id, true, true);
                    $("#npwr").append(newOption).trigger("change");
                    document.getElementById("tgl_pembayaran").value = response.tgl_pembayaran;
                    document.getElementById("jumlah").value = number_format(response.jumlah,2,'.',',');
                    document.getElementById("keterangan").value = response.keterangan;
                    
                    $('#grid_det_pembayaran').DataTable().columns.adjust().responsive.recalc();
                    $("#form-input").show(1000);
                    $(".back").show(1000);
                    $("#front").hide(1000);
                    $(".add").hide(1000);
                }
            });
        });
    });
</script>
@endsection 