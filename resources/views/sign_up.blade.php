<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="description" content="Responsive Admin Template"/>
    <meta name="author" content="SmartUniversity"/>
    <title>Sign-Up</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css"/>
    <!-- icons -->
    <link href="{{("phong-tro-theme/theme/light/assets/plugins/font-awesome/css/font-awesome.min.css")}}"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet"
          href="{{("phong-tro-theme/theme/light/assets/plugins/iconic/css/material-design-iconic-font.min.css")}}">
    <!-- bootstrap -->
    <link href="{{("phong-tro-theme/theme/light/assets/plugins/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <!-- style -->
    <link rel="stylesheet" href="{{("phong-tro-theme/theme/light/assets/css/pages/extra_pages.css")}}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{("phong-tro-theme/theme/light/assets/img/favicon.ico")}}"/>
</head>
<body>
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">
            @if (session('message'))
                <div class="alert alert-success help-block">{{session('message')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger help-block">{{session('error')}}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route("execute.register")}}" method="post" class="login100-form validate-form">
                @csrf
                <span class="login100-form-logo">
						<i class="zmdi zmdi-flower"></i>
					</span>
                <span class="login100-form-title p-b-34 p-t-27">
						Registration
					</span>
                <div class="row">
                    <div class="col-lg-6 p-t-20">
                        <div class="wrap-input100 validate-input" data-validate="Enter Name">
                            <input class="input100" type="text" name="name" placeholder="Name">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="wrap-input100 validate-input" data-validate="Enter email">
                            <input class="input100" type="email" name="email" placeholder="Email">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                    </div>
                    <div class="col-lg-6 p-t-20">
                        <div class="wrap-input100 validate-input" data-validate="Enter password again">
                            <input class="input100" type="password" name="password_confirmation"
                                   placeholder="Confirm password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>
                    </div>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Sign In
                    </button>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="{{url("/")}}">
                        You already have a membership?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- start js include path -->
<script src="{{("phong-tro-theme/theme/light/assets/plugins/jquery/jquery.min.js")}}"></script>
<!-- bootstrap -->
<script src="{{("phong-tro-theme/theme/light/assets/plugins/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{("phong-tro-theme/theme/light/assets/js/pages/extra_pages/login.js")}}"></script>
<!-- end js include path -->
</body>
</html>
