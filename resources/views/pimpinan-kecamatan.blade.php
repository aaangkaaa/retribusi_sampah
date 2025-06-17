@extends('layouts.app')

@section('title', 'Pimpinan Kecamatan')
@section('content')
<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     <h4>Menu Pimpinan Kecamatan</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item active">Pimpinan Kecamatan</li>
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
                        <table id="grid_pimpinan_kecamatan" class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>Kecamatan</b></th>
                                    <th><b>NIP</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Jabatan</b></th>
                                    <th><b>Status Jabatan</b></th>
                                    <th><b>Status Aktif</b></th>
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
                        <h4 class="card-title">Form Input Pimpinan Kecamatan</h4>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" placeholder="NIP" required>
                                        <input type="hidden" class="form-control" id="id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="nama">Nama</label>
                                        <input type="text" class="form-control text-right" id="nama" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="jabatan">Jabatan</label>
                                        <select name="jabatan" id="jabatan" class="form-control" style="width:100%">
                                            <option value="">--Pilih Jabatan--</option>
                                            <option value="Camat">Camat</option>
                                            <option value="Sekcam">Sekertaris Camat</option>
                                            <option value="Bendahara Penerimaan">Bendahara Penerimaan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="status_jabatan">Status Jabatan</label>
                                        <select name="status_jabatan" id="status_jabatan" style='width:100%' class="form-control" required>
                                            <option value="">--Pilih Status Jabatan--</option>
                                            <option value="1">Definitif</option>
                                            <option value="2">Pelaksana Tugas (PLT)</option>
                                            <option value="3">Pelaksana Harian (PLH)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Status Aktif</label>
                                        <div class="form-check form-switch d-inline-block me-2">
                                            <input class="form-check-input " type="checkbox" id="stat">
                                            <label class="form-check-label stat-text">Tidak Aktif</label>
                                        </div>
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
        $('#jabatan').select2({
            placeholder: 'Pilih Jabatan'
        });
        $('#status_jabatan').select2({
            placeholder: '--Pilih Status Jabatan--'
        });
        $('#grid_pimpinan_kecamatan').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('pimpinan-kecamatan/data') }}",
            columns: [
                { data: 'id', name: 'id' ,visible: false, searchable: false},
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'kecamatan', name: 'kecamatan' },
                { data: 'nip', name: 'nip' },
                { data: 'nama', name: 'nama' },
                { data: 'jabatan', name: 'jabatan' },
                { data: 'status_jabatan', name: 'status_jabatan' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', searchable: false }
            ]
        });

        // Add delete button click handler
        $("#grid_pimpinan_kecamatan").on("click", ".delete", function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var token = $('meta[name="csrf-token"]').attr('content');

            Swal.fire({
                title: 'Are you sure?',
                text: "yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ya, hapus!',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('pimpinan-kecamatan/delete') }}",
                        method: 'POST',
                        data: { id: id },
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $("#grid_pimpinan_kecamatan").DataTable().ajax.reload();
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
                                'An error occurred while deleting the data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
        $("#grid_pimpinan_kecamatan").on("click",".edit",function(e){
            var id = $(this).attr('data-id'); 
            var nip = $(this).attr('data-nip'); 
            var nama = $(this).attr('data-nama'); 
            var jabatan = $(this).data('jabatan');
            var status = $(this).data('status');
            var status_jabatan = $(this).data('status-jabatan');
            switch(status_jabatan) {
                case 'Definitif':
                    status_jabatan = 1;
                    break;
                case 'Pelaksana Tugas (PLT)':
                    status_jabatan = 2;
                    break;
                case 'Pelaksana Harian (PLH)':
                    status_jabatan = 3;
                    break;
                default:
                    status_jabatan = 0;
            }
            document.getElementById("id").value = id;
            document.getElementById("nip").value= nip;
            document.getElementById("nama").value = nama;
            $('#jabatan').val(jabatan).trigger('change');
            $('#status_jabatan').val(status_jabatan).trigger('change');
            $('#stat').prop('checked', status == 'Aktif');
            $(".stat-text").text(status);
            $("#form-input").show(1000); 
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });
        $(".add").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("nip").value= "";
            document.getElementById("nama").value = "";
            $("#jabatan").val('').trigger('change');
            $("#status_jabatan").val('').trigger('change');
            document.getElementById("stat").checked = false;
            $("#form-input").show(1000);
            $(".back").show(1000);
            $("#front").hide(1000);
            $(".add").hide(1000);
        });
        $(".back").on("click",function(e){
            document.getElementById("id").value = "";
            document.getElementById("nip").value= "";
            document.getElementById("nama").value = "";
            $("#jabatan").val('').trigger("change")
            $("#status_jabatan").val('').trigger("change")
            document.getElementById("stat").checked = false;
            $("#form-input").hide(1000);
            $(".back").hide(1000);
            $("#front").show(1000);
            $(".add").show(1000);
        });
        $("#stat").on("click",function(e){
            if($(this).is(":checked")) {
                $(".stat-text").text("Aktif");
            } else {
                $(".stat-text").text("Tidak Aktif");
            }
        });
        
        $(".save").on("click", function(e){
            e.preventDefault();
            var kec_id = @json(Session::get('user.kec_id'));
            var id = $("#id").val();
            var nip = $("#nip").val();
            var nama = $("#nama").val();
            var jabatan = $("#jabatan").val();
            var status = $("#stat").is(":checked") ? 1 : 0;
            var status_jabatan = $("#status_jabatan").val();
            // Validasi data
            if(nip == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'NIP tidak boleh kosong',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if(nama == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Nama tidak boleh kosong',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            if(jabatan == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Jabatan tidak boleh kosong',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            if(status_jabatan == "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Status Jabatan tidak boleh kosong',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            
            // Kirim data dengan AJAX
            $.ajax({
                url: "{{ url('pimpinan-kecamatan/save') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    kec_id: kec_id,
                    id: id,
                    nip: nip,
                    nama: nama,
                    jabatan: jabatan,
                    status_jabatan: status_jabatan,
                    status: status
                },
                dataType: "json",
                success: function(response) {
                    if(response.status == "success") {
                        Swal.fire({
                            title: 'Sukses!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                        
                        // Reset form dan kembali ke tampilan tabel
                        $("#id").val("");
                        $("#nip").val("");
                        $("#nama").val("");
                        $("#jabatan").val("").trigger("change");
                        $("#status_jabatan").val("").trigger("change");
                        $("#stat").prop("checked", false);
                        $(".stat-text").text("Tidak Aktif");
                        $("#form-input").hide(1000);
                        $(".back").hide(1000);
                        $("#front").show(1000);
                        $(".add").show(1000);
                        $('#grid_pimpinan_kecamatan').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan: ' + errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
    
</script>
@endsection 