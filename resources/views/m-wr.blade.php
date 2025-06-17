@extends('layouts.app')

@section('title', 'Home')
@section('content')

<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     
                     <h4>Master Wajib Retribusi</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                         <li class="breadcrumb-item active">Wajib Retribusi</li>
                        </ol>
                    </div>
                    <button class="btn btn-danger form-control back" style="display:none;"><span class='fa fa-backward'></span>&nbsp;<b>Kembali</b></button>
                    <button class="btn btn-danger form-control cetak" ><span class="fa fa-print"></span>&nbsp;<b>Cetak Daftar Wajib Retribusi</b></button>
                    <button class="btn btn-primary form-control add" ><span class="fa fa-plus"></span>&nbsp;<b>Tambah Data</b></button>
             </div>
        </div>
        
        <!-- end page title -->
        
        <div class="row">
            <div class="col-xl-12" id='front'>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="kode">Kecamatan</label>
                                    <select id="kec-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="kode">Kelurahan</label>
                                    <select id="kel-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="rw-id">RW</label>
                                    <select id="rw-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="rt-id">RT</label>
                                    <select id="rt-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="grid_1"class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>NPWR</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Alamat</b></th>
                                    <th><b>ID Kecamatan</b></th>
                                    <th><b>Kecamatan</b></th>
                                    <th><b>ID Kelurahan</b></th>
                                    <th><b>Kelurahan</b></th>
                                    <th><b>ID RW</b></th>
                                    <th><b>RW</b></th>
                                    <th><b>ID RT</b></th>
                                    <th><b>RT</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->

            <div class="col-xl-12" id='form-input' style='display:none'>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Input Master Wajib Retribusi</h4>
                        <p class="card-title-desc">Pastikan mengisi semua inputan sebelum menyimpan data.
                        </p>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="row col-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kec">Kecamatan</label>
                                                <input type="text" class="form-control" id="kec"
                                                    placeholder="Kecamatan" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kode">Kelurahan</label>
                                                <input type="text" class="form-control" id="kel"
                                                    placeholder="Kelurahan" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="rw">RW</label>
                                                <input type="text" class="form-control" id="rw"
                                                    placeholder="RW" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="rw">RT</label>
                                                <input type="text" class="form-control" id="rt"
                                                    placeholder="RT" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kode">NPWR</label>
                                                <input type="text" disabled class="form-control" id="npwr"
                                                    placeholder="NPWR" value="" required>
                                                <input type="hidden" class="form-control" id="id">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Nama" value="" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kontak">Kontak</label>
                                                <input type="text" class="form-control" id="kontak"
                                                    placeholder="Kontak" value="" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="nop">NOP</label>
                                                <input type="text" class="form-control" id="nop"
                                                    placeholder="NOP" value="">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="no_kk">NO KK</label>
                                                <input type="text" class="form-control" id="no_kk"
                                                    placeholder="NO KK" value="">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kwh">KWH</label>
                                                <input type="number" class="form-control" id="kwh"
                                                    placeholder="KWH" value="">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 next">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="tarif-id">Tarif</label>
                                                <select class="form-control" style='width:100%' id="tarif-id" placeholder="Tarif">
                                                    <option value=""></option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 next">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="status">Status</label>
                                                <select class="form-control" style='width:100%' id="status" placeholder="Status">
                                                    <option value=""></option>
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Non Aktif</option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="nama">Alamat</label>
                                                <textarea id="alamat" rows="5" style='width:100%'></textarea>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-100">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" >&nbsp;</label>
                                                <button class="btn btn-success form-control save" style='width:100%'><b>Simpan Data</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
<!-- end row -->

<script>
    function load_kecamatan(){
        $('#kec-id').select2({
            placeholder: 'Pilih Kecamatan', // Placeholder
            ajax: {
                url: '{{ url("master-wr/data-kecamatan") }}', // URL ke route
                dataType: 'json',
                delay: 250, 
                data: function (params) {
                    return {
                        q: params.term // Kirim parameter pencarian
                    };
                },
                processResults: function (data) {
                    return {
                        results: data // Data hasil dari controller
                    };
                },
                cache: false
            }
        });
    }
    function load_tarif(){
        $('#tarif-id').select2({
            placeholder: 'Pilih Tarif', // Placeholder
            ajax: {
                url: '{{ url("master-wr/data-tarif") }}', // URL ke route
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term // Kirim parameter pencarian
                    };
                },
                processResults: function (data) {
                    return {
                        results: data // Data hasil dari controller
                    };
                },
                cache: false
            }
        });
    }
    $(document).ready(function() {
        $(".next").hide();
        
        $('#kec-id').select2({
            placeholder: 'Pilih Kecamatan', // Placeholder
        });
        $('#kel-id').select2({
            placeholder: 'Pilih Kelurahan', // Placeholder
        });
        $('#rw-id').select2({
            placeholder: 'Pilih RW', // Placeholder
        });
        $('#rt-id').select2({
            placeholder: 'Pilih RT', // Placeholder
        });
        $('#status').select2({
            placeholder: 'Pilih Status', // Placeholder
        });
        $('#tarif-id').select2({
            placeholder: 'Pilih Status', // Placeholder
        });
        load_kecamatan();
        load_tarif();
        $("#kec-id").select2("open");
        $("#kec-id").select2("close");
        
        
        $("#kec-id").on('select2:select',function(e){
            let kec_id = this.value;
            $('#kel-id').select2({
                placeholder: 'Pilih Kelurahan',
                ajax: {
                    url: '{{ url("master-wr/data-kelurahan") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            kec_id: kec_id
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
        });
        $("#kel-id").on('select2:select',function(e){
            let kel_id = this.value
            $('#rw-id').select2({
                placeholder: 'Pilih RW',
                ajax: {
                    url: '{{ url("master-wr/data-rw") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            kel_id: kel_id
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
            $(".next").show();
        })
        $("#rw-id").on('select2:select',function(e){
            let rw_id = this.value
            $('#rt-id').select2({
                placeholder: 'Pilih RT',
                ajax: {
                    url: '{{ url("master-wr/data-rt") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                            rw_id: rw_id
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: false
                }
            });
        })
        
        $("#rt-id").on('select2:select',function(e){
            let rt_id = this.value;
            table.ajax.url("{{ url('master-wr/data') }}?" + $.param({
                rt_id: rt_id
            })).load();
            table.ajax.reload(null, false);
        })

        table = $('#grid_1').DataTable({
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'npwr', name: 'npwr' },
                { data: 'nama', name: 'nama' },
                { data: 'alamat', name: 'alamat' },
                { data: 'kec_id', name: 'kec_id' ,visible: false, searchable: false},
                { data: 'kecamatan', name: 'alamat' },
                { data: 'kel_id', name: 'kel_id' ,visible: false, searchable: false},
                { data: 'kelurahan', name: 'kelurahan' },
                { data: 'rw_id', name: 'rw_id' ,visible: false, searchable: false},
                { data: 'rw', name: 'rw'},
                { data: 'rt_id', name: 'rt_id' ,visible: false, searchable: false},
                { data: 'rt', name: 'rt' },
                { data: 'action', name: 'action', searchable: false }
            ]
        });

        $("#grid_1").on("click",".edit",function(e){
            var id = $(this).attr('data-id'); 
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('master-wr/data-byId') }}", // URL tujuan
                method: 'GET',
                data: {
                    id
                },
                headers: {
                    'X-CSRF-TOKEN': token // Menyertakan token di header
                },
                success: function(response) {
                    let kecamatan = $("#kec-id").find(":selected").text();
                    let kelurahan = $("#kel-id").find(":selected").text();
                    let rw = $("#rw-id").find(":selected").text();
                    let rt = $("#rt-id").find(":selected").text();
                    let rt_id = $("#rt-id").find(":selected").attr("value");

                    document.getElementById("kec").value= kecamatan;
                    document.getElementById("kel").value= kelurahan;
                    document.getElementById("rw").value= rw;
                    document.getElementById("rt").value= rt;
                    document.getElementById("npwr").value=response[0]['npwr'];
                    document.getElementById("nama").value=response[0]['nama'];
                    document.getElementById("kontak").value=response[0]['kontak'];

                    $("#alamat").val(response[0]['alamat']);
                    let newOption = new Option(response[0]['nm_tarif'], response[0]['tarif_id'], true, true);
                    $("#tarif-id").append(newOption).trigger("change");
                    $("#status").val(response[0]['status']);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
            $(".add").hide(1000);
            $(".cetak").hide(1000);
            $("#front").hide(1000);
            $("#form-input").show(1000);
            $(".back").show(1000);
        });

        // Delete button click handler
        $("#grid_1").on("click", ".delete", function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('master-wr/delete') }}",
                        method: 'POST',
                        data: { id: id },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            if (response.kode == 1) {
                                Swal.fire(
                                    'Terhapus!',
                                    response.message,
                                    'success'
                                );
                                $("#grid_1").DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        
        $(".back").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("npwr").value = "";
            document.getElementById("nama").value= "";
            document.getElementById("kontak").value= "";
            $("#alamat").html("");
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $(".cetak").on("click",function(e){
            window.open("{{ route('master-wr.cetak') }}", "_blank");
        });
        $(".add").on("click",function(e){
            let kecamatan = $("#kec-id").find(":selected").text();
            let kelurahan = $("#kel-id").find(":selected").text();
            let rw = $("#rw-id").find(":selected").text();
            let rt = $("#rt-id").find(":selected").text();
            let rt_id = $("#rt-id").find(":selected").attr("value");
            if(kecamatan == ""){
                Swal.fire(
                    {
                        title: 'Gagal',
                        text: "Pilih kecamatan terleih dahulu..",
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }
                );
                return false;
            }
            if(kelurahan == ""){
                Swal.fire(
                    {
                        title: 'Gagal',
                        text: "Pilih Kelurahan terleih dahulu..",
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }
                );
                return false;
            }
            if(rw == ""){
                Swal.fire(
                    {
                        title: 'Gagal',
                        text: "Pilih RW terleih dahulu..",
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }
                );
                return false;
            }
            if(rt == ""){
                Swal.fire(
                    {
                        title: 'Gagal',
                        text: "Pilih RT terleih dahulu..",
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    }
                );
                return false;
            }
            
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('master-wr/max-kode') }}", // URL tujuan
                method: 'GET',
                data: {
                    rt_id
                },
                headers: {
                    'X-CSRF-TOKEN': token // Menyertakan token di header
                },
                success: function(response) {
                    let kode_kec = $('#kec-id').select2('data')[0]['kode'];
                    let kode_kel = $('#kel-id').select2('data')[0]['kode'];
                    let kode_rw = $('#rw-id').select2('data')[0]['kode'];
                    let kode_rt = $('#rt-id').select2('data')[0]['kode'];
                    document.getElementById("npwr").value = kode_kec+'.'+kode_kel+'.'+kode_rw+'.'+kode_rt+'.'+response[0]['kode'];
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
            document.getElementById("id").value = "";
            document.getElementById("nama").value= "";
            document.getElementById("kontak").value= "";
            document.getElementById("kec").value= kecamatan;
            document.getElementById("kel").value= kelurahan;
            document.getElementById("rw").value= rw;
            document.getElementById("rt").value= rt;
            $("#alamat").html("");
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
            $(".cetak").hide(1000);
        });

        $(".save").on("click",function(e){
            e.preventDefault();
            var id = document.getElementById("id").value;
            var npwr = document.getElementById("npwr").value;
            var nama = document.getElementById("nama").value;
            var rt_id  = $("#rt-id").find(":selected").attr("value");
            var tarif_id  = $("#tarif-id").find(":selected").attr("value");
            var status  = $("#status").find(":selected").attr("value");
            var alamat = $("#alamat").val();
            var kontak = document.getElementById("kontak").value;
            var nop = document.getElementById("nop").value;
            var no_kk = document.getElementById("no_kk").value;
            var kwh = document.getElementById("kwh").value;
            var token = $('meta[name="csrf-token"]').attr('content');

            // Menyusun request AJAX
            $.ajax({
                url: "{{ url('master-wr/save-data') }}", // URL tujuan
                method: 'POST',
                data: {
                    id,npwr,nama,rt_id,tarif_id,status,alamat,kontak,nop,no_kk,kwh
                },
                headers: {
                    'X-CSRF-TOKEN': token // Menyertakan token di header
                },
                success: function(response) {
                    console.log('Response:', response);
                    if(response.kode == 1){
                        
                        Swal.fire(
                            {
                                title: 'Good job!',
                                text: response.message,
                                icon: 'success',
                                timer: 2500,
                                showCancelButton: false,
                                showConfirmButton: false
                            }
                        )
                        $("#form-input").hide(1000);
                        $(".back").hide(1000);
                        $("#grid_1").DataTable().ajax.reload();
                        $("#front").show(1000);
                        $(".add").show(1000);
                        $(".cetak").show(1000);
                    }
                    else{
                        var timerInterval;
                        Swal.fire(
                            {
                                title: 'Gagal',
                                text: response.message,
                                icon: 'error',
                                timer: 1000,
                                showConfirmButton: false, 
                                onBeforeOpen:function () {
                                    Swal.showLoading()
                                },
                                onClose: function () {
                                    clearInterval(timerInterval)
                                }
                                }).then(function (result) {
                                if (
                                    // Read more about handling dismissals
                                    result.dismiss === Swal.DismissReason.timer
                                ) {
                                    console.log('I was closed by the timer')
                                }
                            }
                        );
                    }
                    
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
@endsection
