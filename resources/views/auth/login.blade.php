<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Customer Admin Panel</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/morris.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-jvectormap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/horizontal-timeline.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/ion.rangeSlider.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/ion.rangeSlider.skinFlat.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">

    <!-- Page Level Stylesheets -->

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Login Page Start -->
        <div class="m-account-w" data-bg-img="{{ asset('public/assets/img/account/wrapper-bg.jpg')}}">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <!-- Login Content Start -->
                        <div class="m-account--content-w" data-bg-img="{{ asset('public/assets/img/account/content-bg.jpg')}}">
                            <div class="m-account--content">
                                <h2 class="h2">Don't have an account?</h2>
                                <p>Please Contact Our Sale Representative
                                </p>
                                <a href="register.html" class="btn btn-rounded">Register Now</a>
                            </div>
                        </div>
                        <!-- Login Content End -->
                    </div>

                    <div class="col-md-6">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="{{ asset('public/assets/img/logo.png')}}" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="{{ url('customers/dologin')}}" method="post">
                                	{{ csrf_field() }}
                                    <label class="m-account--title">Login to your account</label>
                                    @if(!empty(session('errormsg')))<div class="alert alert-danger">  {{session('errormsg') }}</div> @endif

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="form-control" autocomplete="off" required>
                                            
                                        </div>
                                        <span class="text-danger">@if($errors->first('username')) {{ $errors->first('username') }} @endif</span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" value="{{ old('password') }}" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                        </div>
                                        <span class="text-danger">@if($errors->first('password')) {{ $errors->first('password') }} @endif</span>
                                    </div>

                                    <div class="m-account--actions">
                                        <a href="#" class="btn-link">Forgot Password?</a>

                                        <button type="submit" class="btn btn-rounded btn-info">Login</button>
                                    </div>

                                    <div class="m-account--alt">
                                        <p><span>OR LOGIN WITH</span></p>

                                        <div class="btn-list">
                                            <a href="#" class="btn btn-rounded btn-warning">Facebook</a>
                                            <a href="#" class="btn btn-rounded btn-warning">Google</a>
                                        </div>
                                    </div>

                                    <div class="m-account--footer">
                                        <p>&copy; 2018 Invictus Solutions</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.sparkline.min.j')}}s"></script>
    <script src="{{ asset('public/assets/js/raphael.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/morris.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/select2.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery-jvectormap.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery-jvectormap-world-mill.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/horizontal-timeline.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/dropzone.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/main.js')}}"></script>

    <!-- Page Level Scripts -->

</body>
</html>
