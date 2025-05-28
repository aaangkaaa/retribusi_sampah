<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Retribusi Sampah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">

                            <h3 class="text-center mt-5 mb-4">
                                <a href="index.html" class="d-block auth-logo">
                                    <img src="{{ asset('assets/images/Simlurah Color.svg') }}" alt="" height="50" class="auth-logo-dark">
                                    <img src="{{ asset('assets/images/Simlurah White Color.svg') }}" alt="" height="50" class="auth-logo-light">
                                </a>
                            </h3>

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mb-1 text-center">Retribusi Sampah</h4>
                                <p class="text-muted text-center form-login">Sign in to continue to Simlurah.</p>
                                <p class="text-muted text-center form-register" style='display:none'>Register</p>
                                <div class="form-login">
                                    <form class="form-horizontal mt-4">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Enter password">
                                        </div>
                                        <div class="mb-3 row mt-4">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="customControlInline">
                                                    <label class="form-check-label" for="customControlInline">Remember me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light login"
                                                    type="submit">Log In</button>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-4">
                                                <a href="pages-recoverpw.html" class="text-muted"><i
                                                        class="mdi mdi-lock"></i> Forgot your password?</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="form-register" style="display: none">
                                    
                                    <div id="error-messages" style="color: red;"></div>
                                    <form class="form-horizontal mt-4">
                                        <div class="mb-3">
                                            <label for="mail2"><span  style="color: red;">* </span>Email</label>
                                            <input type="email" class="form-control" id="email2"
                                                placeholder="Enter email">
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="username2"><span  style="color: red;">* </span>Username</label>
                                            <input type="text" class="form-control" id="username2"
                                                placeholder="Enter username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kec-id">Kecamatan</label>
                                            <select class="form-control" id="kec-id" style="width:100%"></select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kel-id">Kelurahan</label>
                                            <select class="form-control" id="kel-id" style="width:100%"></select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role-id">Role</label>
                                            <select class="form-control" id="role-id" style="width:100%">
                                                <option value=""></option>
                                                <option value="0">ADMIN</option>
                                                <option value="1">KECAMATAN</option>
                                                <option value="2">KELURAHAN</option>
                                                <option value="3">WARGA</option>
                                            </select>
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="password2"><span  style="color: red;">* </span>Password</label>
                                            <input type="password" class="form-control" id="password2"
                                                placeholder="Enter password">
                                        </div>
    
                                        <div class="mb-3 row mt-4">
                                            <div class="col-12 text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light register"
                                                    type="submit">Register</button>
                                            </div>
                                        </div>
    
                                        <div class="mb-0 row">
                                            <div class="col-12 mt-4">
                                                <p class="text-muted mb-0 font-size-14">Sudah punya akun ?
                                                    <a id='open-login' class="text-primary">Silahkan Login</a>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p class='form-login'>Belum punya akun ? <a id='open-register' class="text-primary"> Daftar Sekarang </a>
                        </p>
                        ©
                        <script>document.write(new Date().getFullYear())</script> Retribusi Sampah <span
                            class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i>
                            by Simlurah.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#role-id').select2({
                placeholder: 'Pilih Role',
                allowClear: true
            });
            $('#kec-id').select2({
                placeholder: 'Pilih Kecamatan',
                allowClear: true,
                ajax: {
                    url: '{{ url("master-rw/data-kecamatan") }}', 
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
            $("#kec-id").on("change",function(e){
                let kec_id = this.value;
                $('#kel-id').select2({
                    placeholder: 'Pilih Kelurahan',
                    allowClear: true,
                    ajax: {
                        url: '{{ url("master-rw/data-kelurahan") }}',
                        dataType: 'json',
                        delay: 250,
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
                        cache: true
                    }
                });
            });
            $("#open-register").on("click",function(e){
                e.preventDefault();
                $(".form-login").hide(1000);
                $(".form-register").show(1000);
            })
            $("#open-login").on("click",function(e){
                e.preventDefault();
                $(".form-register").hide(1000);
                $(".form-login").show(1000);
            })
            $(".login").on("click",function(e){
                e.preventDefault();
                var email = document.getElementById("email").value;
                var password = document.getElementById("password").value;
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('login') }}", // URL tujuan
                    method: 'POST',
                    data: {
                        email,password
                    },
                    headers: {
                        'X-CSRF-TOKEN': token // Menyertakan token di header
                    },
                    success: function(response) {
                        console.log('Response:', response+" kode:"+response.kode);
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
                            window.location.href = "{{ route('dashboard') }}";
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
                        console.error('Error:', error.email);
                    }
                });
            });
            $(".register").on("click",function(e){
                e.preventDefault();
                var email = document.getElementById("email2").value;
                var username = document.getElementById("username2").value;
                var password = document.getElementById("password2").value;
                var kec_id = $("#kec-id").find(":selected").attr("value");
                var kel_id = $("#kel-id").find(":selected").attr("value");
                var role_id = $("#role-id").find(":selected").attr("value");
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ url('register') }}", // URL tujuan
                    method: 'POST',
                    data: {
                        email,username,password,kec_id,kel_id,role_id
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
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        var errors = xhr.responseJSON.errors; // Ambil error dari respons JSON
                        var errorMessages = '';

                        // Loop untuk menampilkan semua error
                        $.each(errors, function(key, value) {
                            errorMessages += '<p>*' + value[0] + '</p>'; // Menampilkan pesan error
                        });

                        // Menampilkan pesan error di dalam div #error-messages
                        $('#error-messages').html(errorMessages);
                    }
                });
            });
        });
    </script>
</body>

</html>