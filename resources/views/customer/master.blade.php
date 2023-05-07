<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Mobile Web-app fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Meta tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <!--Title-->
    <title>Colina - Hotel, Resort & Accommodation Website Template</title>

    <!--CSS styles-->
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/bootstrap.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/animate.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/font-awesome.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/linear-icons.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/hotel-icons.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/magnific-popup.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/owl.carousel.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/datepicker.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/theme.css') }}" />
    <link rel="stylesheet" media="all" href="{{ asset('assets/customer/css/style.css') }}" />


    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&amp;subset=latin-ext" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="page-loader"></div>

    <div class="wrapper">
        @if(session('message'))
        @include('component.alert', ['title' => session('message')])
        @endif
        <header>
            <div class="container">
                <nav class="navigation-top clearfix">
                    <div class="navigation-top-left">
                        <a class="box" href="#">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class="box" href="#">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class="box" href="#">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </div>
                    <div class="navigation-top-right">
                        <a class="box" href="{{ route('home') }}">
                            <i class="icon icon-star"></i>
                            Trang chủ
                        </a>
                        <a class="box" href="{{ route('customer.rooms') }}">
                            <i class="icon icon-tag"></i>
                            Danh sách phòng
                        </a>
                        <a class="box" href="#">
                            <i class="icon icon-phone-handset"></i>
                            (01) 252-3333
                        </a>
                    </div>
                </nav>
                <nav class="navigation-main clearfix">
                    <div class="logo animated fadeIn">
                        <a href="{{ route('home') }}">
                            <img class="logo-desktop" src="{{ asset('assets/images/logoF.png') }}"
                                alt="Alternate Text" />
                            <img class="logo-mobile" src="{{ asset('assets/images/logoF.png') }}"
                                alt="Alternate Text" />
                        </a>
                    </div>
                    <div class="toggle-menu"><i class="icon icon-menu"></i></div>
                    <div class="navigation-block clearfix">
                        <!-- navigation-right -->
                        <ul class="navigation-right">
                            @if(!auth()->guard('customers')->check())
                            <li>
                                <button class="btn btn-auth" data-toggle="modal" data-target="#register">Đăng ký
                                </button>
                                <div class="modal fade" id="register" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Đăng ký</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="register-customer" action="{{ route('customer.register') }}"
                                                    method="POST" novalidate enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div data-repeater-list="outer-group" class="outer">
                                                        <div data-repeater-item class="outer">
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Tên khách
                                                                    hàng</label>
                                                                <div class="col-lg-10">
                                                                    <input id="name" name="name" type="text"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập tên khách hàng..." required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Số CMTND/
                                                                    Thẻ căn cước</label>
                                                                <div class="col-lg-10">
                                                                    <input id="id_card" name="id_card" type="number"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập số CMTND/ Thẻ căn cước..."
                                                                        required maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for=""
                                                                    class="col-form-label col-lg-2">Email</label>
                                                                <div class="col-lg-10">
                                                                    <input id="email" name="email" type="text"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập địa chỉ email" required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Mật
                                                                    khẩu</label>
                                                                <div class="col-lg-10">
                                                                    <input name="password" type="password"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập mật khẩu" required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Nhập lại
                                                                    mật khẩu</label>
                                                                <div class="col-lg-10">
                                                                    <input name="re_password" type="password"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập lại mật khẩu" required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Ngày
                                                                    sinh</label>
                                                                <div class="col-lg-10">
                                                                    <input id="date_of_birth" name="date_of_birth"
                                                                        type="date" class="form-control remove-Invalid"
                                                                        placeholder="Nhập ngày sinh..." required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Công việc
                                                                    hiện tại</label>
                                                                <div class="col-lg-10">
                                                                    <input id="job" name="job" type="text"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập công việc hiện tại..."
                                                                        required maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Địa
                                                                    chỉ</label>
                                                                <div class="col-lg-10">
                                                                    <input id="address" name="address" type="text"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập địa chỉ..." required
                                                                        maxlength="100">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2">Giới
                                                                    tính</label>
                                                                <div class="col-lg-10">
                                                                    <select name="sex" id="sex"
                                                                        class="mdl-js-textfield form-control form-control-sm txt-full-width"
                                                                        required>
                                                                        <option value="0" selected>Nữ</option>
                                                                        <option value="1">Nam</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="col-form-label col-lg-2"> Số điện
                                                                    thoại</label>
                                                                <div class="col-lg-10">
                                                                    <input id="phone" name="phone"
                                                                        class="form-control remove-Invalid"
                                                                        placeholder="Nhập số điện thoại..." required
                                                                        maxlength="10">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end">
                                                        <div class="col-lg-12 cancel">
                                                            <button type="submit" id="edit" class="btn">
                                                                <i class="fa fa-plus-square"></i>
                                                                Đăng ký
                                                            </button>
                                                            <input class="btn" type="button" value="Hủy bỏ" onclick="">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <button class="btn btn-auth" data-toggle="modal" data-target="#login">Đăng nhập</button>
                                <div class="modal fade" id="login" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Đăng nhập</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('customer.handle-login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                                            aria-describedby="emailHelp" placeholder="Enter email"
                                                            name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Mật khẩu</label>
                                                        <input type="password" name="password" class="form-control"
                                                            id="exampleInputPassword1" placeholder="Password" required>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary" value="Đăng nhập">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li>
                                <a href="#">Cá nhân<span class="open-dropdown"><i
                                            class="fa fa-angle-down"></i></span></a>
                                <ul>
                                    <li><a href="{{ route('customer.show') }}">Thông tin cá nhân</a></li>
                                    <li><a href="{{ route('customer.contract-list') }}">Thông tin hợp đồng</a></li>
                                    <li><a href="{{ route('customer.bills-show') }}">Thanh toán hóa đơn</a></li>
                                    <li><a href="{{ url('change-password') }}">Đổi mật khẩu</a></li>
                                    <li><a href="{{ route('customer.logout') }}">Đăng xuất</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <section class="frontpage-slider">
            <div class="owl-slider owl-slider-header owl-slider-fullscreen">
                <div class="item" style="background-image:url({{ asset('upload/images/unnamed.jpg') }})">
                    <div class="box text-center">
                        <div class="container">
                            <div class="rating animated" data-animation="fadeInDown">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h2 class="title animated h1" data-animation="fadeInDown">
                                Ngay bây giờ <br /> <span>hãy đến với chúng tôi</span>
                            </h2>
                            <div class="desc animated" data-animation="fadeInUp">
                                Nhà trọ Vui Vẻ
                            </div>
                            <div class="desc animated" data-animation="fadeInUp">
                                Xóm trọ thân thiện, vui vẻ và an ninh tốt
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="background-image:url('')">
                    <div class="box text-center">
                        <div class="container">
                            <h2 class="title animated h1" data-animation="fadeInDown">
                                The privacy and <br />
                                individuality of a custom
                            </h2>
                            <div class="desc animated" data-animation="fadeInUp">
                                The Residences have their own dedicated private entrance as well <br />
                                as an anonymous "celebrity" entrance, for ultimate privacy.
                            </div>
                            <div class="animated" data-animation="fadeInUp">
                                <a href="#" class="btn btn-clean">Virtual tour</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item" style="background-image:url({{ asset('upload/images/unnamed (2).jpg') }})">
                    <div class="box text-center">
                        <div class="container">
                            <div class="rating animated" data-animation="fadeInDown">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h2 class="title animated h1" data-animation="fadeInDown">Fairmont managed!</h2>
                            <div class="desc animated" data-animation="fadeInUp">The elegant Champagne Bar, the stylish
                                Colina Club.
                            </div>
                            <div class="desc animated" data-animation="fadeInUp">Guestrooms and luxurious suites</div>
                            <div class="animated" data-animation="fadeInUp">
                                <a href="#" class="btn btn-clean">Get insipred</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @yield('content')
        <footer>
            <div class="container">

                <!--footer links-->
                <div class="footer-links">
                    <div class="row">
                        <div class="col-sm-6 footer-left">
                            <a href="#">Sitemap</a> &nbsp; | &nbsp; <a href="#">Privacy policy</a> | &nbsp; <a
                                href="#">Guest
                                book</a>
                        </div>
                        <div class="col-sm-6 footer-right">
                            <a href="#">Gallery</a> &nbsp; | &nbsp; <a href="#">Reservations</a> | &nbsp; <a
                                href="#">Help
                                center</a>
                        </div>
                    </div>
                </div>

                <!--footer social-->

                <div class="footer-social">
                    <div class="row">
                        <div class="col-sm-12 text-center hidden">
                            <a href="" class="footer-logo"><img src="{{ asset('assets/images/logo.png') }}"
                                    alt="Alternate Text" /></a>
                        </div>
                        <div class="col-sm-12 icons">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-sm-12 copyright">
                            <small>Copyright &copy; 2017 &nbsp; | &nbsp; <a
                                    href="https://themeforest.net/item/colina-hotel-website-template/20977257">Buy
                                    Colina
                                    Template</a></small>
                        </div>
                        <div class="col-sm-12 text-center">
                            <img src="{{ asset('assets/images/logo-footerF.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <style>
    .item {
        object-fit: cover;
    }
    </style>
    <script src="{{ asset('assets/customer/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/customer/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/customer/js/jquery.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/customer/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/customer/js/jquery.owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/customer/js/main.js') }}"></script>
</body>

</html>