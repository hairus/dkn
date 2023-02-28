<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Aplikasi, Anisa, Anisa Jatim, Aplikasi Anisa, Aplikasi Anisa Jatim, Aplikasi Nilai Sekolah Asal, Indeks Sekolah Asal">
    <meta name="description"
        content="ANISA JATIM - Aplikasi Nilai Sekolah Asal yang dikembangkan oleh UPT TIKP Dinas Pendidikan Provinsi Jawa Timur untuk mendapkan Indeks Sekolah Asal SMP/Sederajat.">
    <meta name="robots" content="noindex,nofollow">
    <title>ANISAJATIM</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('temp/assets/images/logo_provinsi.png') }}" >
    <!-- Custom CSS -->
    <link href="{{ asset('/temp/dist/css/style.min.css')}}" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center pt-3 pb-3">
                        <span class="db"><img src="{{ asset('/temp/assets/images/logo_provinsi.png')}}" alt="logo" style="width:180px;height:272px"/></span>
                        <h1 class="mt-3 text-white" style="font-family: arial">ANISAJATIM</h1>
                        <h2 class="mt-3 text-white" style="font-family: arial">Aplikasi Nilai Sekolah Asal</h2>
                        <h1 class="mt-3 text-white" style="font-family: arial">TIKP DISDIK JATIM</h1>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal mt-3" id="loginform"  action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" placeholder="NPSN" aria-label="npsn" aria-describedby="basic-addon1" name="npsn" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="PASSWORD" aria-label="Password" aria-describedby="basic-addon1" required="" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3">
                                        {{-- <button class="btn btn-info" id="to-recover" type="button"><i class="fa fa-lock me-1"></i> Lost password?</button> --}}
                                        <button class="btn btn-success float-end text-white mb-3" type="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i class="ti-email"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3 pt-3 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back To Login</a>
                                    <button class="btn btn-info float-end" type="button" name="action">Recover</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('/temp/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('/temp/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>

    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){

        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    </script>

</body>

</html>
