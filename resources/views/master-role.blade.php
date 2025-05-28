@extends('layouts.app')

@section('title', 'Master Role')
@section('content')
<!-- Tambahkan meta tag CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4>Master Role</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                        <li class="breadcrumb-item active">Role</li>
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
                                    <th><b>Nama Role</b></th>
                                    <th><b>Keterangan</b></th>
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
                        <h4 class="card-title">Form Input Role</h4>
                        <form class="needs-validation" novalidate>
                            <input type="hidden" id="id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="nama">Nama Role</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Role" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" placeholder="Keterangan">
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
                            </div>
                        </form>
                        <div id="menu-akses">
                            <hr>
                            <h5>Hak Akses Menu</h5>
                            <div id="menu-tree"></div>
                            <div class="mb-3 mt-3">
                                <button class="btn btn-success form-control save"><b>Simpan Data</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Tambahkan ajaxSetup agar semua request AJAX mengirim CSRF token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    var table = $('#grid_1').DataTable({
        ajax: "{{ url('master-role/data') }}",
        columns: [
            { data: 'id', visible: false },
            { data: 'DT_RowIndex', searchable: false },
            { data: 'nama' },
            { data: 'keterangan' },
            { data: 'is_active', render: function(data) {
                return data == 1 ? 'Aktif' : 'Non Aktif';
            }},
            { data: 'action', searchable: false }
        ]
    });
    $('.add').click(function() {
        $('#form-input').show();
        $('#front').hide();
        $('.back').show();
        $('.add').hide();
        $('#menu-akses').show();
        loadMenuAkses('');
    });
    $('.back').click(function() {
        $('#form-input').hide();
        $('#front').show();
        $('.back').hide();
        $('.add').show();
        resetForm();
        $('#menu-akses').hide();
    });
    $('#grid_1').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.get("{{ url('master-role/data-byId') }}", {id: id}, function(data) {
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#keterangan').val(data.keterangan);
            $('#status').val(data.is_active);
            $('#form-input').show();
            $('#front').hide();
            $('.back').show();
            $('.add').hide();
            $('#menu-akses').show();
            loadMenuAkses(id);
        });
    });
    $('.save').click(function(e) {
        e.preventDefault();
        var data = {
            id: $('#id').val(),
            nama: $('#nama').val(),
            keterangan: $('#keterangan').val(),
            is_active: $('#status').val()
        };
        // Ambil hak akses menu
        var menu_permissions = [];
        $('#menu-tree input.can_view').each(function() {
            var menu_id = $(this).data('menu');
            menu_permissions.push({
                menu_id: menu_id,
                can_view: $('#menu-tree input.can_view[data-menu="'+menu_id+'"]').is(':checked') ? 1 : 0,
                can_add: $('#menu-tree input.can_add[data-menu="'+menu_id+'"]').is(':checked') ? 1 : 0,
                can_edit: $('#menu-tree input.can_edit[data-menu="'+menu_id+'"]').is(':checked') ? 1 : 0,
                can_delete: $('#menu-tree input.can_delete[data-menu="'+menu_id+'"]').is(':checked') ? 1 : 0
            });
        });
        data.menu_permissions = menu_permissions;
        $.ajax({
            url: "{{ url('master-role/save') }}",
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
    function resetForm() {
        $('#id').val('');
        $('#nama').val('');
        $('#keterangan').val('');
        $('#status').val('1');
        $('#menu-akses').hide();
        $('#menu-tree').html('');
    }
    function loadMenuAkses(role_id) {
        $('#menu-tree').html('Loading...');
        $.get("{{ url('master-role/get-menu') }}", function(menus) {
            $.get("{{ url('master-role/get-role-menu') }}", {role_id: role_id}, function(roleMenus) {
                var html = buildMenuTree(menus, roleMenus);
                $('#menu-tree').html(html);
            });
        });
    }
    function buildMenuTree(menus, roleMenus, level = 0) {
        var html = '';
        menus.forEach(function(menu) {
            var akses = roleMenus.find(rm => rm.menu_id == menu.id) || {};
            var hasChild = menu.children && menu.children.length > 0;
            var margin = 20 + (level * 30);
            html += '<div class="card mb-2" style="margin-left:'+margin+'px">';
            html += '<div class="card-body py-2 px-3">';
            html += '<div class="d-flex align-items-center">';
            if(menu.icon) html += '<i class="'+menu.icon+' me-2"></i>';
            html += '<b>'+menu.nama+'</b>';
            html += '<div class="ms-auto">';
            if(!hasChild || level > 0) {
                html += '<div class="form-check form-switch d-inline-block me-2">';
                html += '<input class="form-check-input all_access" type="checkbox" data-menu="'+menu.id+'" '+(
                    akses.can_view && akses.can_add && akses.can_edit && akses.can_delete ? 'checked' : ''
                )+'> <label class="form-check-label">All Access</label>';
                html += '</div>';
                html += '<div class="form-check form-switch d-inline-block me-2">';
                html += '<input class="form-check-input can_view" type="checkbox" data-menu="'+menu.id+'" '+(akses.can_view ? 'checked' : '')+'> <label class="form-check-label">View</label>';
                html += '</div>';
                html += '<div class="form-check form-switch d-inline-block me-2">';
                html += '<input class="form-check-input can_add" type="checkbox" data-menu="'+menu.id+'" '+(akses.can_add ? 'checked' : '')+'> <label class="form-check-label">Add</label>';
                html += '</div>';
                html += '<div class="form-check form-switch d-inline-block me-2">';
                html += '<input class="form-check-input can_edit" type="checkbox" data-menu="'+menu.id+'" '+(akses.can_edit ? 'checked' : '')+'> <label class="form-check-label">Edit</label>';
                html += '</div>';
                html += '<div class="form-check form-switch d-inline-block">';
                html += '<input class="form-check-input can_delete" type="checkbox" data-menu="'+menu.id+'" '+(akses.can_delete ? 'checked' : '')+'> <label class="form-check-label">Delete</label>';
                html += '</div>';
            }
            html += '</div>';
            html += '</div>';
            if(hasChild) {
                html += buildMenuTree(menu.children, roleMenus, level+1);
            }
            html += '</div></div>';
        });
        return html;
    }
    $(document).on('change', '.can_view', function() {
        var checked = $(this).is(':checked');
        if(checked) {
            var parentCard = $(this).closest('.card').parent().closest('.card');
            if(parentCard.length) {
                parentCard.find('input.can_view').first().prop('checked', true);
            }
        } else {
            var card = $(this).closest('.card');
            card.find('.card .can_view').prop('checked', false);
        }
    });
    // Event: All Access
    $(document).on('change', '.all_access', function() {
        var checked = $(this).is(':checked');
        var card = $(this).closest('.card');
        card.find('.can_view, .can_add, .can_edit, .can_delete').prop('checked', checked);
    });
    // Sinkronisasi All Access jika semua hak akses dicentang manual
    $(document).on('change', '.can_view, .can_add, .can_edit, .can_delete', function() {
        var card = $(this).closest('.card');
        var allChecked = card.find('.can_view, .can_add, .can_edit, .can_delete').filter(':checked').length === 4;
        card.find('.all_access').prop('checked', allChecked);
    });
    // Delete Button Click
    $('#grid_1').on('click', '.delete', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Apakah Anda yakin ingin menghapus data role ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('master-role/delete') }}",
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
                            $('#grid_1').DataTable().ajax.reload();
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
});
</script>
@endsection 