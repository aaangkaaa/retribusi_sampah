@extends('layouts.app')

@section('title', 'Master Kolektor')
@section('content')

<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     
                     <h4>Master Kolektor</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                         <li class="breadcrumb-item active">Kolektor</li>
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
                        <table id="grid_1"class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>kelurahan id</b></th>
                                    <th><b>kecamatan id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>Kecamatan</b></th>
                                    <th><b>Kelurahan</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Status</b></th>
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
                        <h4 class="card-title">Form Input Master Kolektor</h4>
                        <p class="card-title-desc">Pastikan mengisi semua inputan sebelum menyimpan data.
                        </p>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="row col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kec-id">Kecamatan</label>
                                                <select id="kec-id" class="form-control" style="width: 100%"></select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="kel-id">Kelurahan</label>
                                                <select id="kel-id" class="form-control" style="width: 100%"></select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 next">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="nik">NIK</label>
                                                <input type="text" class="form-control" id="nik"
                                                    placeholder="NIK Kolektor" value="">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 next">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama"
                                                    placeholder="Nama Kolektor" value="" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 next">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label">Status Aktif</label>
                                                <div class="form-check form-switch d-inline-block me-2">
                                                    <input class="form-check-input " type="checkbox" id="stat" value="Aktif" checked>
                                                    <label class="form-check-label stat-text">Aktif</label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" id="id">
                                        <div class="col-md-4 next">
                                            <div class="mb-3 position-relative">
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
                url: '{{ url("master-kolektor/data-kecamatan") }}', // URL ke route
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
        // $(".next").hide();
        
        $('#kec-id').select2({
            placeholder: 'Pilih Kecamatan', // Placeholder
        });
        $('#kel-id').select2({
            placeholder: 'Pilih Kelurahan', // Placeholder
        });
        load_kecamatan();
        $("#kec-id").select2("open");
        $("#kec-id").select2("close");
        
        $("#kec-id").on("change",function(e){
            let kec_id = this.value;
            $('#kel-id').select2({
                placeholder: 'Pilih Kelurahan', // Placeholder
                ajax: {
                    url: '{{ url("master-kolektor/data-kelurahan") }}', // URL ke route
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
        })
        var table = $('#grid_1').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('master-kolektor/data') }}",
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'kel_id', name: 'id' ,visible: false, searchable: false},
                { data: 'kec_id', name: 'id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'kecamatan', name: 'kecamatan', searchable: false },
                { data: 'kelurahan', name: 'kelurahan', searchable: true },
                { data: 'nama', name: 'nama' },
                { 
                    data: 'status', 
                    name: 'status',
                    render: function(data, type, row) {
                        var checked = (data == 'Aktif' || data == '1' || data == 1) ? 'checked' : '';
                        var labelText = (data == 'Aktif' || data == '1' || data == 1) ? 'Aktif' : 'Tidak Aktif';
                        return `
                            <div class="form-check form-switch d-inline-block me-2">
                                <input class="form-check-input status-switch" type="checkbox" data-id="${row.id}" ${checked}>
                                <label class="form-check-label status-text" for="statusSwitch${row.id}">${labelText}</label>
                            </div>
                        `;
                    }
                },
                { data: 'action', name: 'action', searchable: false }
            ]
        });

        // Removed duplicate DataTable initialization for #grid_1
        
        $("#stat").on("click",function(e){
            if($(this).is(":checked")) {
                $(".stat-text").text("Aktif");
            } else {
                $(".stat-text").text("Tidak Aktif");
            }
        });
        // Event handler for status button click (optional, if you want to toggle status)
        $('#grid_1').on('change', '.status-switch', function() {
            var id = $(this).data('id');
            var isChecked = $(this).is(':checked');
            var label = $(this).siblings('.status-text');
            var newStatus = isChecked ? 'Aktif' : 'Tidak Aktif';

            // Update label text
            label.text(newStatus);

            // Send AJAX request to update status in backend (implement route and controller accordingly)
            $.ajax({
                url: "{{ url('master-kolektor/update-status') }}",
                method: 'POST',
                data: {
                    id: id,
                    status: newStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.kode != 1) {
                        alert('Gagal mengubah status');
                        // Revert checkbox state on failure
                        $(this).prop('checked', !isChecked);
                        label.text(isChecked ? 'Tidak Aktif' : 'Aktif');
                    }
                    $("#grid_1").DataTable().ajax.reload();
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengubah status');
                    // Revert checkbox state on error
                    $(this).prop('checked', !isChecked);
                    label.text(isChecked ? 'Tidak Aktif' : 'Aktif');
                }
            });
        });

        $("#grid_1").on("click",".edit",function(e){
            var id = $(this).attr('data-id'); 
            var nama = $(this).attr('data-nama');
            var nik = $(this).attr('data-nik');
            var status = $(this).attr('data-status');
            var kec_id = $(this).attr('data-kec-id');
            var kel_id = $(this).attr('data-kel-id');
            $("#kec-id").append('<option value="'+kec_id+'" selected>'+$(this).attr('data-kec-nama')+'</option>');
            $("#kel-id").append('<option value="'+kel_id+'" selected>'+$(this).attr('data-kel-nama')+'</option>');
            document.getElementById("id").value = id;
            document.getElementById("nama").value= nama;
            document.getElementById("nik").value= nik;
            document.getElementById("stat").value= status;
            $(".add").hide(1000);
            $("#front").hide(1000);
            $("#form-input").show(1000);
            $(".back").show(1000);
        })
        
        $(".back").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("nama").value= "";
            document.getElementById("nik").value= "";
            $("#kec-id").val("").trigger("change");
            $("#kel-id").val("").trigger("change");
            document.getElementById("stat").value= "";
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $(".add").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("nama").value= "";
            document.getElementById("nik").value= "";
            $("#kec-id").val("").trigger("change");
            $("#kel-id").val("").trigger("change");
            document.getElementById("stat").value= "";
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });
        

        $(".save").on("click",function(e){
            e.preventDefault();
            var id = document.getElementById("id").value;
            var nama = document.getElementById("nama").value;
            var nik = document.getElementById("nik").value;
            var status = $("#stat").is(":checked") ? 1 : 0;
            var kel_id  = $("#kel-id").find(":selected").attr("value");
            var token = $('meta[name="csrf-token"]').attr('content');

            // Menyusun request AJAX
            $.ajax({
                url: "{{ url('master-kolektor/save-data') }}", // URL tujuan
                method: 'POST',
                data: {
                    id,kel_id,nama,nik,status
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
                        document.getElementById("id").value = "";
                        document.getElementById("nama").value= ""; 
                        document.getElementById("nik").value= ""; 
                        $("#kec-id").val("").trigger("change");
                        $("#kel-id").val("").trigger("change");
                        $("#grid_1").DataTable().ajax.reload();
                        $("#form-input").hide(1000);
                        $(".back").hide(1000);
                        $("#front").show(1000);
                        $(".add").show(1000);
                        $('#grid_1').DataTable().columns.adjust().responsive.recalc();
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
