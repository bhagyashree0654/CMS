<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Codekart EMS</title>
          <!-- Favicon-->
    <link rel="shortcut icon" href="public/assets/img/CMS-WHITE.png">
    <!-- Favicons -->
  <link href="public/assets/img/CMS-WHITE.png" rel="icon">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="public/css/login.css" rel="stylesheet" />
    </head>
    <body class="stop-scrolling">
        <!-- Background Video-->
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="public/assets/mp4/bg1.mp4" type="video/mp4" /></video>
        <!-- Masthead-->
        <header>           
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    {{-- <a class="navbar-brand" href=""><img class="logo" src="public/assets/img/4.png" alt=""></a> --}}
                    <a class="navbar-brand" href=""><img class="logo" src="public/assets/img/CMS-WHITE.png" alt=""></a>
                    {{-- <img src="public/assets/img/logo.png" alt="" id="logo"> --}}
                </div>
            </nav>
          
        </header>
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <h2 class="fst-italic lh-1 mb-4 text-center hd">Codekart Employee Management System</h2>
                    <form id="contactForm" action="loginValidate" method="POST" onsubmit="return validate()">
                        <div class="form-group text-center">
                            <label for="username">Username</label>
                            <input type="text" class="form-control m-2" id="username" name="username" aria-describedby="username" placeholder="Username">
                            <input type="hidden" class="form-control tooltips" name="_token" id="_token" value="{{ csrf_token() }}"/>
                            <input type="hidden" class="form-control" id="hidId" name="hidId" aria-describedby="id">
                            <span id="usererr" class="text-danger mt-2"></span>
                        </div>
                        <div class="form-group text-center">
                            <label for="password">Password</label>
                            <input type="password" class="form-control m-2" id="password" name="password" placeholder="Password">
                            <span id="passerr" class="text-danger mt-3"></span>
                        </div>
                        <div class="text-center">                              
                          <button type="submit" name="login" class="btn btn-info mt-4">Log In</button>
                        </div>
                        <div class="text-center mt-3 ">
                            <p class="text-center text-danger" style="font-size: 15px;">{{$message ?? ''}}</p>
                            <p class="text-center text-info" style="font-size: 15px;">{{$resetMsg ?? ''}}</p>
                        </div>
                        <div class="text-center mt-3 ">
                            <a href="forgetpass" style="font-size: 20px; text-decoration: none;color:#5aff15;">Forget Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Social Icons-->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="https://twitter.com/codekart?lang=en"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="https://www.facebook.com/TheCodeKart/"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="https://www.instagram.com/thecodekart/?igshid=ohzrg2vli3a&hl=en"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-dark m-3" href="https://in.linkedin.com/company/codekart"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="public/js/login.js"></script>
    </body>
</html>
