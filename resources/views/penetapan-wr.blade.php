@extends('layouts.app')

@section('title', 'Home')
@section('content')
 
<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     
                     <h4>Master Penetapan Wajib Retribusi</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                         <li class="breadcrumb-item active">Penetapan Wajib Retribusi Bulanan</li>
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="bulan">&nbsp;</label>
                                    <select id="bulan" class="form-control bulan select2" style="width: 100%">
                                        <option value="">Pilih Bulan</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="tahun">&nbsp;</label>
                                    <select id="tahun" class="form-control tahun select2" style="width: 100%">
                                        <option value="">Pilih Bulan</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                    </select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-danger form-control cetak_skrd_all"><span class='far fa-file-pdf'></span>&nbsp;<b>Cetak SKRD Keseluruhan</b></button>
                                </div>
                            </div>
                        </div>
                        <table id="grid_1"class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>PERIODE</b></th>
                                    <th><b>No.Seri</b></th>
                                    <th><b>NPWR</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Alamat</b></th>
                                    <th><b>Kelurahan</b></th>
                                    <th><b>RW</b></th>
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
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="rw">Tanggal Penetapan</label>
                                                {{-- <input type="date" class="form-control" id="tgl_penetapan" placeholder="Pilih Tanggal"> --}}
                                                <input type="text" id='tgl_penetapan' class="form-control datepicker" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="rw">Tanggal Jatuh Tempo</label>
                                                <input type="text" id='tgl_tempo' class="form-control datepicker" placeholder="yyyy-mm-dd">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="tahun2">Tahun</label>
                                                <select id="tahun2" class="form-control tahun select2" style="width: 100%">
                                                    <option value="">Pilih Bulan</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="bulan2">Bulan</label>
                                                <select id="bulan2" class="form-control bulan" style="width: 100%">
                                                    <option value="">Pilih Bulan</option>
                                                    <option value="1">Januari</option>
                                                    <option value="2">Februari</option>
                                                    <option value="3">Maret</option>
                                                    <option value="4">April</option>
                                                    <option value="5">Mei</option>
                                                    <option value="6">Juni</option>
                                                    <option value="7">Juli</option>
                                                    <option value="8">Agustus</option>
                                                    <option value="9">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-100">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" >&nbsp;</label>
                                                <button class="btn btn-success form-control save" style='width:100%'><b>Proses Penetapan</b></button>
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
        
        $('.bulan').select2({
            placeholder: 'Pilih Bulan'
        });
        $('.tahun').select2({
            placeholder: 'Pilih Tahun'
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            "autoclose": true
        })
        .on('changeDate', function(ev) {
            $(this).datepicker('hide');
        });
        $('.datepicker').css({
            'z-index': '100000 !important'
        })
        
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
        
        $("#bulan").on('select2:select',function(e){
            console.log("periodex :"+this.value);
            table.ajax.url("{{ url('penetapan-wr/data') }}?" + $.param({
                bulan: this.value
            })).load();
            table.ajax.reload(null, false);
        })

        table = $('#grid_1').DataTable({
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'periode', name: 'periode' },
                { data: 'no_seri', name: 'no_seri' },
                { data: 'npwr', name: 'npwr' },
                { data: 'nama', name: 'nama' },
                { data: 'alamat', name: 'alamat' },
                { data: 'kelurahan', name: 'kelurahan' },
                { data: 'rw', name: 'rw'},
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
            $("#front").hide(1000);
            $("#form-input").show(1000);
            $(".back").show(1000);
        })
        
        $(".back").on("click",function(e){
            document.getElementById("tahun").value = "2025";
            document.getElementById("bulan2").value = "";
            document.getElementById("tgl_penetapan").value= "";
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $(".add").on("click",function(e){
            document.getElementById("kec").value=@json($kec->nama);
            var token = $('meta[name="csrf-token"]').attr('content');
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });

        $(".cetak_skrd_all").on("click",function(e){
            e.preventDefault();
            var tahun = document.getElementById("tahun").value;
            var bulan = $("#bulan").val();
            window.open("{{ url('penetapan-wr/cetak_all') }}?tahun=" + tahun + "&bulan=" + bulan, "_blank");
        });
        
        $(".save").on("click",function(e){
            e.preventDefault();
            var tahun = document.getElementById("tahun2").value;
            var bulan = $("#bulan2").val();
            var tgl_penetapan = document.getElementById("tgl_penetapan").value;
            var tgl_tempo = document.getElementById("tgl_tempo").value;
            var token = $('meta[name="csrf-token"]').attr('content');

            // Menyusun request AJAX
            $.ajax({
                url: "{{ url('penetapan-wr/save-data') }}", // URL tujuan
                method: 'POST',
                data: {
                    tahun,bulan,tgl_penetapan,tgl_tempo
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
                        table.ajax.url("{{ url('penetapan-wr/data') }}?" + $.param({
                            bulan: bulan,
                            tahun: tahun
                        })).load();
                        table.ajax.reload(null, false);
                        $("#front").show(1000);
                        $(".add").show(1000);
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

        // --- Tambahan event onchange bulan dan tahun ---
        function reloadPenetapanTable() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var kec_id = @json(Session::get('user.kec_id'));
            if (bulan && tahun) {
                table.ajax.url("{{ url('penetapan-wr/data') }}?bulan=" + bulan + "&tahun=" + tahun + "&kec_id=" + kec_id).load();
            }
        }
        $('#bulan, #tahun').on('change', function() {
            reloadPenetapanTable();
        });
        // --- END Tambahan ---
    });
</script>
@endsection
