@extends('layouts.app')

@section('title', 'Master User')
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4>Master User</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                                    <th><b>Nama</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Kecamatan</b></th>
                                    <th><b>Kelurahan</b></th>
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
                        <h4 class="card-title">Form Input User</h4>
                        <p class="card-title-desc">Pastikan mengisi semua inputan sebelum menyimpan data.</p>
                        <form class="needs-validation" novalidate>
                            <input type="hidden" id="id" name="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="kec-id">Kecamatan</label>
                                        <select id="kec-id" class="form-control" style="width: 100%"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="kel-id">Kelurahan</label>
                                        <select id="kel-id" class="form-control" style="width: 100%"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="role-id">Role</label>
                                        <select id="role-id" class="form-control" style="width: 100%"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="is_active">Status</label>
                                        <select id="is_active" class="form-control" style="width: 100%">
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

<!-- Tambahkan meta tag CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
// Tambahkan ajaxSetup agar semua request AJAX mengirim CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    var table = $('#grid_1').DataTable({
        ajax: "{{ url('master-user/data') }}",
        columns: [
            { data: 'id', visible: false },
            { data: 'DT_RowIndex', searchable: false },
            { data: 'name' },
            { data: 'email' },
            { data: 'kecamatan' },
            { data: 'kelurahan' },
            { data: 'is_active', render: function(data) {
                return data == 1 ? 'Aktif' : 'Non Aktif';
            }},
            { data: 'action', searchable: false }
        ]
    });

    // Load Kecamatan
    $('#kec-id').select2({
        placeholder: 'Pilih Kecamatan',
        ajax: {
            url: '{{ url("master-user/data-kecamatan") }}',
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

    // Load Kelurahan
    $('#kel-id').select2({
        placeholder: 'Pilih Kelurahan',
        ajax: {
            url: '{{ url("master-wr/data-kelurahan") }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    kec_id: $('#kec-id').val()
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

    // Load Role
    $('#role-id').select2({
        placeholder: 'Pilih Role',
        ajax: {
            url: '{{ url("master-user/data-role") }}',
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

    // Load Status
    $('#is_active').select2({
        placeholder: 'Pilih Status',
        allowClear: true
    });

    // Add Button Click
    $('.add').click(function() {
        $('#form-input').show();
        $('#front').hide();
        $('.back').show();
        $('.add').hide();
        $('#password').prop('required', true);
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
        $.get("{{ url('master-user/data-byId') }}", {id: id}, function(data) {
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').prop('required', false);
            $('#is_active').val(data.is_active).trigger('change');
            
            // Set Kecamatan
            if(data.kec_id) {
                var newOption = new Option(data.kecamatan, data.kec_id, true, true);
                $('#kec-id').empty().append(newOption).trigger('change');
                
                // Load Kelurahan setelah Kecamatan dipilih
                $.get("{{ url('master-wr/data-kelurahan') }}", {
                    kec_id: data.kec_id,
                    q: ''
                }, function(kelData) {
                    if(data.kel_id) {
                        var kelOption = new Option(data.kelurahan, data.kel_id, true, true);
                        $('#kel-id').empty().append(kelOption).trigger('change');
                    }
                });
            }
            
            // Set Role
            if(data.role_id) {
                var newOption = new Option(data.role, data.role_id, true, true);
                $('#role-id').empty().append(newOption).trigger('change');
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
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            kec_id: $('#kec-id').val(),
            kel_id: $('#kel-id').val(),
            role_id: $('#role-id').val(),
            is_active: $('#is_active').val()
        };

        $.ajax({
            url: "{{ url('master-user/save') }}",
            type: "POST",
            data: data,
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
                    $('#role-id').val(null).trigger('change');
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
                $.ajax({
                    url: "{{ url('master-user/delete') }}",
                    type: "POST",
                    data: { id: id },
                    success: function(response) {
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
                    }
                });
            }
        });
    });

    function resetForm() {
        $('#name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#kec-id').val(null).trigger('change');
        $('#kel-id').val(null).trigger('change');
        $('#role-id').val(null).trigger('change');
        $('#is_active').val('1');
    }
});
</script>
@endsection 