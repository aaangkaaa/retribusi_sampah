@extends('layouts.app')

@section('title', 'Home')
@section('content')

<div class="row">
    <div class="col-xl-12">
         <!-- start page title -->
         <div class="row">
             <div class="col-sm-12">
                 <div class="page-title-box">
                     
                     <h4>Master Tarif</h4>
                     <ol class="breadcrumb m-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Retribusi Sampah</a></li>
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Master</a></li>
                         <li class="breadcrumb-item active">Tarif</li>
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
                                    <th><b>No.</b></th>
                                    <th><b>Nama</b></th>
                                    <th><b>Tarif</b></th>
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
                        <h4 class="card-title">Form Input Master Tarif</h4>
                        <p class="card-title-desc">Pastikan mengisi semua inputan sebelum menyimpan data.
                        </p>
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="kode">Nama</label>
                                        <input type="text" class="form-control" id="nama"
                                            placeholder="Ketik Nama Tarif" value="" required>
                                        <input type="hidden" class="form-control" id="id">
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="nilai">Tarif</label>
                                        <input type="text" class="form-control text-right" id="nilai"
                                            placeholder="Tarif Kecamatan" onkeypress="return(currencyFormat(this,',','.',event))" value="0.00" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" >&nbsp;</label>
                                        <button class="btn btn-success form-control save"><span class='far fa-save fa-lg'></span>&nbsp;<b>Simpan Data</b></button>
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
        $(document).ready(function() {
            $('#grid_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('master-tarif/data') }}",
                columns: [
                    { data: 'id', name: 'id' ,visible: false, searchable: false},
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'nilai', name: 'nilai' },
                    { data: 'action', name: 'action', searchable: false }
                ],
                columnDefs: [
                    {
                        "targets": 3,
                        "render": function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return number_format(data, 2, '.', ',');
                            }
                            return data;
                        }
                    }
                ]
            });

            $("#grid_1").on("click",".edit",function(e){
                var id = $(this).attr('data-id'); 
                var nama = $(this).attr('data-nama');
                var nilai = $(this).attr('data-nilai'); 
                document.getElementById("id").value = id;
                document.getElementById("nama").value= nama;
                document.getElementById("nilai").value = number_format(nilai,2,'.',',');
                $(".add").hide(1000);
                $("#front").hide(1000);
                $("#form-input").show(1000);
                $(".back").show(1000);
            })
            
            $(".back").on("click",function(e){
                document.getElementById("id").value = "";
                document.getElementById("nama").value= "";
                document.getElementById("nilai").value = "0.00";
                $("#form-input").hide(1000);
                $(".back").hide(1000);
                $("#front").show(1000);
                $(".add").show(1000);
            });
            $(".add").on("click",function(e){
                document.getElementById("id").value = "";
                document.getElementById("nama").value= "";
                document.getElementById("nilai").value = "0.00";
                $("#form-input").show(1000);
                $(".back").show(1000);
                $("#front").hide(1000);
                $(".add").hide(1000);
            });

            $(".save").on("click",function(e){
                e.preventDefault();
                var id = document.getElementById("id").value;
                var nama = document.getElementById("nama").value;
                var nilai = angka(document.getElementById("nilai").value);
                var token = $('meta[name="csrf-token"]').attr('content');

                // Menyusun request AJAX
                $.ajax({
                    url: "{{ url('master-tarif/save-data') }}", // URL tujuan
                    method: 'POST',
                    data: {
                        id,nama,nilai
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

            // Add delete button click handler
            $("#grid_1").on("click", ".delete", function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var token = $('meta[name="csrf-token"]').attr('content');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Kamu akan menghapus data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ya, hapus!',
                    cancelButtonText: 'Tidak, batalkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('master-tarif/delete') }}",
                            method: 'POST',
                            data: { id: id },
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            success: function(response) {
                                if (response.kode == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    );
                                    $("#grid_1").DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Failed!',
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
        });
    </script>
@endsection
