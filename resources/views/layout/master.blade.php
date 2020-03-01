<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Welcome to Dashboard</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="_token" content="{{ csrf_token() }}">

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
    @stack('css')
    <!-- Page Level Stylesheets -->

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
        <header class="navbar navbar-fixed">
            <!-- Navbar Header Start -->
            <div class="navbar--header">
                <!-- Logo Start -->
                <a href="index.html" class="logo">
                    <img src="{{ asset('public/assets/img/logo.png')}}" class="img img-responsive" width="150" alt="">
                </a>
                <!-- Logo End -->

                <!-- Sidebar Toggle Button Start -->
                <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Sidebar Toggle Button End -->
            </div>
            <!-- Navbar Header End --> 

            <!-- Sidebar Toggle Button Start -->
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Sidebar Toggle Button End -->

            <!-- Navbar Search Start -->
            <div class="navbar--search">
                <form action="search-results.html">
                    <input type="search" name="search" class="form-control" placeholder="Search Something..." required>
                    <button class="btn-link"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <!-- Navbar Search End -->

            <div class="navbar--nav ml-auto">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-bell"></i>
                            <span class="badge text-white bg-blue">7</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="mailbox_inbox.html" class="nav-link">
                            <i class="fa fa-envelope"></i>
                            <span class="badge text-white bg-blue">4</span>
                        </a>
                    </li>

                    <!-- Nav Language Start -->
                    <li class="nav-item dropdown nav-language">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <img src="assets/img/flags/us.png" alt="">
                            <span>English</span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="">
                                    <img src="assets/img/flags/de.png" alt="">
                                    <span>German</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <img src="assets/img/flags/fr.png" alt="">
                                    <span>French</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <img src="assets/img/flags/us.png" alt="">
                                    <span>English</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Nav Language End -->

                    <!-- Nav User Start -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <img class="img img-responsive" src="{{ asset('public/assets/userslogo/')}}/{{ Auth::user()->shop_logo}}" alt="" class="rounded-circle">
                            <span>{{ Auth::user()->shop_owner}}</span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="profile.html"><i class="far fa-user"></i>Profile</a></li>
                            <li><a href="{{ url('customers/company-setting')}}"><i class="fa fa-cog"></i>Settings</a></li>
                            <li class="dropdown-divider"></li>
                            
                            <li><a href="{{ url('customers/logout') }}"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                    <!-- Nav User End -->
                </ul>
            </div>
        </header>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Profile Start -->
            <div class="sidebar--profile">
                <div class="profile--img">
                    <a href="profile.html">
                        <img src="{{ asset('public/assets/userslogo/')}}/{{ Auth::user()->shop_logo}}" alt="" class="img img-responsive img-circle">
                    </a>
                </div>

                <div class="profile--name">
                    <a href="profile.html" class="btn-link">{{ Auth::user()->shop_owner}}</a>
                </div>

                <div class="profile--nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="profile.html" class="nav-link" title="User Profile">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('customers/company-setting')}}" class="nav-link" title="Settings">
                                <i class="fa fa-cog"></i>
                            </a>
                        </li>
                        
                        
                        <li class="nav-item">
                            <a href="{{ url('customers/logout') }}" class="nav-link" title="Logout">
                                <i class="fa fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sidebar Profile End -->

            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li>
                        <ul>
                            <li>
                                <a href="{{ url('customers/dashboard')}}">
                                    <i class="fa fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Product</span>
                                </a>

                                <ul>
                                    <li class="active"><a href="{{ url('customers/categories')}}/0">Categories</a></li>
                                    <li><a href="{{ url('customers/attributes')}}">Attributes</a></li>
                                    <li><a href="{{ url('customers/add-new-product')}}">Add New Product</a></li>
                                    <li><a href="{{ url('customers/products') }}">All products</a></li>
                                    <li><a href="{{ url('customers/brands')}}">Brands</a></li>
                                    <li><a href="{{ url('customers/currency-conversion')}}">Currency Conversion</a></li>
                                 <li><a href="{{ url('customers/shipment-charges')}}"> Shipment Charges</a></li>
								</ul>
                            </li>
                            <li>
                                <a href="{{ url('customers/orders')}}">
                                    <i class="fa fa-list"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('customers/blogs')}}">
                                    <i class="fa fa-rss"></i>
                                    <span>Blogs</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('customers/vendors')}}">
                                    <i class="fa fa-handshake"></i>
                                    <span>Vendors</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    <span>Static Content</span>
                                </a>

                                <ul>
                                    <li class=""><a href="{{ url('customers/categories')}}/0">About Us</a></li>
                                    <li class=""><a href="{{ url('customers/categories')}}/0">Slider</a></li>
                                    <li class=""><a href="{{ url('customers/categories')}}/0">Testimonials</a></li>
                                    <li class="active"><a href="{{ url('customers/categories')}}/0">Contact Us</a></li>
                                    
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Sidebar Navigation End -->

            <!-- Sidebar Widgets Start -->
            <div class="sidebar--widgets">
                <div class="widget">
                    <h3 class="h6 widget--title">Information Summary</h3>

                    <!-- Summary Widget Start -->
                    <div class="summary--widget">
                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#2bb3c0">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Daily Traffic</p>
                            <p class="summary--stats">307.512</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                            <p class="summary--title">Average Usage</p>
                            <p class="summary--stats">2,371,527</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#cccccc">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Disk Usage</p>
                            <p class="summary--stats">37.5%</p>
                        </div>

                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                            <p class="summary--title">CPU Usage</p>
                            <p class="summary--stats">37.05-32</p>
                        </div>
                        
                        <div class="summary--item">
                            <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#ff4040">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                            <p class="summary--title">Memory Usage</p>
                            <p class="summary--stats">37.05%</p>
                        </div>
                    </div>
                    <!-- Summary Widget End -->
                </div>
            </div>
            <!-- Sidebar Widgets End -->
        </aside>
        <!-- Sidebar End -->

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
           
            <!-- Page Header End -->

            <!-- Main Content Start -->
            @yield('content')
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <footer class="main--footer main--footer-light">
                <p>Copyright &copy; <a href="#">Invictus Solutions</a>. All Rights Reserved.</p>
            </footer>
            <!-- Main Footer End -->
        </main>
        <!-- Main Container End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('public/assets/js/jquery.sparkline.min.js')}}"></script>
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
    @stack('js')

    <!-- Page Level Scripts -->

</body>
</html>
