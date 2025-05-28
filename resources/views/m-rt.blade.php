@extends('layouts.app')

@section('title', 'Home')
@section('content')

<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     
                     <h4>Master RT</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                         <li class="breadcrumb-item active">RT</li>
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
                                    <label class="form-label" for="kode">Kecamatan</label>
                                    <select id="kec-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="kode">Kelurahan</label>
                                    <select id="kel-id" class="form-control" style="width: 100%"></select>
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3 position-relative">
                                    <label class="form-label" for="rw-id">RW</label>
                                    <select id="rw-id" class="form-control" style="width: 100%"></select>
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
                                    <th><b>kelurahan id</b></th>
                                    <th><b>kecamatan id</b></th>
                                    <th><b>rw id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>Kecamatan</b></th>
                                    <th><b>Kelurahan</b></th>
                                    <th><b>RW</b></th>
                                    <th><b>Kode</b></th>
                                    <th><b>Nama</b></th>
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
                        <h4 class="card-title">Form Input Master RT</h4>
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
                                                    placeholder="Kode" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="rw">RW</label>
                                                <input type="text" class="form-control" id="rw"
                                                    placeholder="Kode" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kode">Kode</label>
                                                <input type="text" class="form-control" id="kode"
                                                    placeholder="Kode" value="" required>
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
                                                    placeholder="Nama RW" value="" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" >&nbsp;</label>
                                                <button class="btn btn-success form-control save"><b>Simpan Data</b></button>
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
                url: '{{ url("master-rt/data-kecamatan") }}', // URL ke route
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
        load_kecamatan();
        $("#kec-id").select2("open");
        $("#kec-id").select2("close");
        
        $("#kec-id").on("change",function(e){
            let kec_id = this.value;
            $('#kel-id').select2({
                placeholder: 'Pilih Kelurahan', // Placeholder 
                ajax: {
                    url: '{{ url("master-rt/data-kelurahan") }}', // URL ke route
                    dataType: 'json',
                    // delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            kec_id: kec_id// Kirim parameter pencarian
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
        });
        $("#kel-id").on("change",function(e){
            let kel_id = this.value;
            $('#rw-id').select2({
                placeholder: 'Pilih RW', // Placeholder
                ajax: {
                    url: '{{ url("master-rt/data-rw") }}', // URL ke route
                    dataType: 'json',
                    // delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            kel_id: kel_id// Kirim parameter pencarian
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
        }) 
        $("#rw-id").on("change",function(e){
            let rw_id = this.value;
            table.ajax.url("{{ url('master-rt/data') }}?" + $.param({
                rw_id: rw_id
            })).load();
            table.ajax.reload(null, false);
           
        })

        table = $('#grid_1').DataTable({
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'rw_id', name: 'rw_id' ,visible: false, searchable: false},
                { data: 'kel_id', name: 'kel_id' ,visible: false, searchable: false},
                { data: 'kec_id', name: 'kec_id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'kecamatan', name: 'kecamatan' },
                { data: 'kelurahan', name: 'kelurahan' },
                { data: 'rw', name: 'rw' },
                { data: 'kode', name: 'kode' },
                { data: 'nama', name: 'nama' },
                { data: 'action', name: 'action', searchable: false }
            ]
        });

        $("#grid_1").on("click",".edit",function(e){
            var id = $(this).attr('data-id'); 
            var kode = $(this).attr('data-kode'); 
            var nama = $(this).attr('data-nama');
            var rw_id = $(this).attr('data-rw-id');
            var kel_id = $(this).attr('data-kel-id');
            var kec_id = $(this).attr('data-kec-id');
            document.getElementById("id").value = id;
            document.getElementById("kode").value = kode;
            document.getElementById("nama").value= nama;
            $("#kec-id").val(kec_id).trigger("change");
            console.log(kec_id+"ss");
            var timer = setInterval(function() {
                var ready_kel = $("#kel-id").html();
                // console.log("kd_rekx: "+ready_kd_rek)  
                if (ready_kel != "") {
                    clearInterval(timer);
                    $("#kel-id").val(kel_id).trigger('change');
                };
            }, 1000);
            var timer = setInterval(function() {
                var ready_rw = $("#rw-id").html();
                // console.log("kd_rekx: "+ready_kd_rek)  
                if (ready_rw != "") {
                    clearInterval(timer);
                    $("#rw-id").val(rw_id).trigger('change');
                };
            }, 1000);
            $(".add").hide(1000);
            $("#front").hide(1000);
            $("#form-input").show(1000);
            $(".back").show(1000);
        })
        
        $(".back").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("kode").value = "";
            document.getElementById("nama").value= "";
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $(".add").on("click",function(e){
            let kecamatan = $("#kec-id").find(":selected").text();
            let kelurahan = $("#kel-id").find(":selected").text();
            let rw = $("#rw-id").find(":selected").text();
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
            document.getElementById("id").value = "";
            document.getElementById("kode").value = "";
            document.getElementById("nama").value= "";
            document.getElementById("kec").value=kecamatan;
            document.getElementById("kel").value=kelurahan;
            document.getElementById("rw").value=rw;
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });

        $(".save").on("click",function(e){
            e.preventDefault();
            var id = document.getElementById("id").value;
            var kode = document.getElementById("kode").value;
            var nama = document.getElementById("nama").value;
            var rw_id  = $("#rw-id").find(":selected").attr("value");
            var token = $('meta[name="csrf-token"]').attr('content');

            // Menyusun request AJAX
            $.ajax({
                url: "{{ url('master-rt/save-data') }}", // URL tujuan
                method: 'POST',
                data: {
                    id,rw_id,kode,nama
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
