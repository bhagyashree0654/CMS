<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forget Password</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Mega Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="codedthemes" />
      <!-- Favicon icon -->

       <!-- Favicon-->
    <link rel="shortcut icon" href="public/assets/img/CMS-WHITE.png">
    <!-- Favicons -->
  <link href="public/assets/img/CMS-WHITE.png" rel="icon">
      <!-- Google font-->     
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="public/assets/assets/css/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="public/assets/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="public/assets/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="public/assets/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="public/assets/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="public/assets/assets/css/style.css">
  </head>

  <body themebg-pattern="theme1">
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->                    
                        <form class="md-float-material form-material" action="sendOTPvalidation" method="POST" onsubmit="return validateUser()">
                            @csrf
                            <div class="text-center">
                                <img src="public/assets/img/logo.png" alt="" height="30px" width="auto">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Search your Username</h3>
                                        </div class="col-md-12 text-center">
                                            <h5 class="text-danger">{{$error ?? " "}}</h5>
                                        <div>

                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off">
                                        <span id="usererr" class="text-danger"></span>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Search</button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <p class="text-inverse text-left m-b-0">Thank you.</p>
                                            <p class="text-inverse text-left"><a href="login"><b>Back to website</b></a></p>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="public/assets/img/1.png" alt="" height="90px" width="auto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
<!-- Required Jquery -->
    <script type="text/javascript" src="public/assets/assets/js/jquery/jquery.min.js"></script>
     <script type="text/javascript" src="public/assets/assets/js/jquery-ui/jquery-ui.min.js "></script>     <script type="text/javascript" src="public/assets/assets/js/popper.js/popper.min.js"></script>     <script type="text/javascript" src="public/assets/assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="public/assets/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="public/assets/assets/js/jquery-slimscroll/jquery.slimscroll.js "></script>
<!-- modernizr js -->
<script type="text/javascript" src="public/assets/assets/js/SmoothScroll.js"></script>
<script src="public/assets/assets/js/jquery.mCustomScrollbar.concat.min.js "></script>
<script type="text/javascript" src="public/assets/assets/js/common-pages.js"></script>
<script src="public/js/login.js"></script>
</body>

</html>
