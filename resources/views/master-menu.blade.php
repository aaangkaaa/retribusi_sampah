@extends('layouts.app')

@section('title', 'Master Menu')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4>Master Menu</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                        <li class="breadcrumb-item active">Menu</li>
                    </ol>
                </div>
                <button class="btn btn-danger form-control back" style="display:none;"><span class='fa fa-backward'></span>&nbsp;<b>Kembali</b></button>
                <button class="btn btn-primary form-control add"><span class="fa fa-plus"></span>&nbsp;<b>Tambah Data</b></button>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12" id='front'>
                <div class="card">
                    <div class="card-body">
                        <table id="grid_1" class="display responsive" width="100%" style='font-size:11px;'>
                            <thead>
                                <tr>
                                    <th><b>id</b></th>
                                    <th><b>No.</b></th>
                                    <th><b>Nama Menu</b></th>
                                    <th><b>Icon</b></th>
                                    <th><b>URL</b></th>
                                    <th><b>Parent Menu</b></th>
                                    <th><b>Urutan</b></th>
                                    <th><b>Status</b></th>
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
                        <h4 class="card-title">Form Input Menu</h4>
                        <p class="card-title-desc">Pastikan mengisi semua inputan sebelum menyimpan data.</p>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="nama">Nama Menu</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Menu" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="icon">Icon</label>
                                        <input type="text" class="form-control" id="icon" placeholder="Icon (contoh: fa fa-home)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="url">URL</label>
                                        <input type="text" class="form-control" id="url" placeholder="URL">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="parent-id">Parent Menu</label>
                                        <select id="parent-id" class="form-control" style="width: 100%">
                                            <option value="">Menu Utama</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="urutan">Urutan</label>
                                        <input type="number" class="form-control" id="urutan" placeholder="Urutan" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="status">Status</label>
                                        <select class="form-control" id="status">
                                            <option value="1">Aktif</option>
                                            <option value="0">Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 position-relative">
                                        <button class="btn btn-success form-control save"><b>Simpan Data</b></button>
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
    var table = $('#grid_1').DataTable({
        ajax: "{{ url('master-menu/data') }}",
        columns: [
            { data: 'id', visible: false },
            { data: 'DT_RowIndex', searchable: false },
            { data: 'nama' },
            { data: 'icon' },
            { data: 'url' },
            { data: 'parent_nama' },
            { data: 'urutan' },
            { data: 'is_active', render: function(data) {
                return data == 1 ? 'Aktif' : 'Non Aktif';
            }},
            { data: 'action', searchable: false }
        ]
    });

    $('#parent-id').select2({
        placeholder: 'Pilih Parent Menu',
        ajax: {
            url: '{{ url("master-menu/parent-menu") }}',
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
            cache: false
        }
    });

    // Add Button Click
    $('.add').click(function() {
        $('#form-input').show();
        $('#front').hide();
        $('.back').show();
        $('.add').hide();
    });

    // Back Button Click
    $('.back').click(function() {
        $('#form-input').hide();
        $('#front').show();
        $('.back').hide();
        $('.add').show();
        resetForm();
    });

    // Edit Button Click
    $('#grid_1').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.get("{{ url('master-menu/data-byId') }}", {id: id}, function(data) {
            $('#nama').val(data.nama);
            $('#icon').val(data.icon);
            $('#url').val(data.url);
            $('#urutan').val(data.urutan);
            $('#status').val(data.is_active);
            
            // Set Parent Menu
            if(data.parent_id) {
                var newOption = new Option(data.parent_nama, data.parent_id, true, true);
                $('#parent-id').append(newOption).trigger('change');
            }
            
            $('#form-input').show();
            $('#front').hide();
            $('.back').show();
            $('.add').hide();
        });
    });

    // Save Button Click
    $('.save').click(function(e) {
        e.preventDefault();
        var data = {
            id: $('#id').val(),
            nama: $('#nama').val(),
            icon: $('#icon').val(),
            url: $('#url').val(),
            parent_id: $('#parent-id').val(),
            urutan: $('#urutan').val(),
            is_active: $('#status').val()
        };
        var token = $('meta[name="csrf-token"]').attr('content'); 

        $.ajax({
            url: "{{ url('master-menu/save') }}",
            type: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': token // Menyertakan token di header
            },
            success: function(response) {
                if(response.kode == 1) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#form-input').hide();
                    $('#front').show();
                    $('.back').hide();
                    $('.add').show();
                    resetForm();
                    table.ajax.reload();
                } else {
                    Swal.fire({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            }
        });
    });

    // Delete Button Click
    $('#grid_1').on('click', '.delete', function() {
        var id = $(this).data('id');
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
                $.get("{{ url('master-menu/delete') }}", {id: id}, function(response) {
                    if(response.kode == 1) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: response.message,
                            icon: 'error',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });

    function resetForm() {
        $('#nama').val('');
        $('#icon').val('');
        $('#url').val('');
        $('#parent-id').val(null).trigger('change');
        $('#urutan').val('');
        $('#status').val('1');
    }

    // Kondisi icon: hanya aktif & required jika parent_id kosong (level 1)
    $('#parent-id').on('change', function() {
        if($(this).val()) {
            $('#icon').prop('disabled', true).prop('required', false).val('');
        } else {
            $('#icon').prop('disabled', false).prop('required', true);
        }
    });
    // Trigger saat edit juga
    if($('#parent-id').val()) {
        $('#icon').prop('disabled', true).prop('required', false);
    } else {
        $('#icon').prop('disabled', false).prop('required', true);
    }
});
</script>
@endsection 