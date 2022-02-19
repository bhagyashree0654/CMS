<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('title') </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="public/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="public/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="public/css/style.default.css" id="theme-stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">  
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" /> --}}
    <!--sweetalert-->
	  <link rel="stylesheet" href="public/sweet-alert/css/sweetalert2.min.css"/>

    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="public/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="public/assets/img/CMS-WHITE.png">
    <!-- Favicons -->
  <link href="public/assets/img/CMS-WHITE.png" rel="icon">
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="eindex" class="navbar-brand">
              {{-- <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Code</strong><strong>Kart</strong></div> --}}
              <div class="brand-text brand-big visible text-uppercase"> <img src="public/assets/img/CMS-WHITE.png" alt="" height="80px" width="auto"> </div>
              {{-- <div class="brand-text brand-sm"><strong class="text-primary">C</strong><strong>K</strong></div></a> --}}
              <div class="brand-text brand-sm"><img src="public/assets/img/CMS-WHITE.png" alt="" height="70px" width="auto"></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">  
            <!-- Log out -->
            <div class="list-inline-item logout"><a id="logout" href="logout" class="nav-link">Logout <i class="icon-logout"></i></a></div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center"> 

          @if(session("photo") == "" || session("photo") == null)
            <div class="avatar"><img src="public/assets/img/staff.jpg" alt="..." class="img-fluid rounded-circle" style="background-color: #fff"></div>
          @else
          <div class="avatar"><img src="public/members/employees/{{session('photo')}}" alt="" class="img-fluid rounded-circle"><img src="public/members/managers/{{session('photo')}}" alt="" class="img-fluid rounded-circle"></div>
          @endif
          <div class="title">
            <h1 class="h5">{{session('display_name')}}</h1>
            <span>{{session('emp_code')}}</span><span> {{session('hr_code')}}</span> <span>{{session('admin_code')}}</span><span>{{session('mng_code')}}</span><span>{{session('mngr_code')}}</span>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          @foreach($menu ?? "" as $row)

              @if($menu_name == $row->link_text)
              <li class="active"><a href="{{$row->resource_name}}?menu_name={{$row->link_text}}"><i class="{{$row->icons}}"></i>{{$row->link_text}} </a></li>

              @else
                  <li><a href="{{$row->resource_name}}?menu_name={{$row->link_text}}"><i class="{{$row->icons}}"></i>{{$row->link_text}} </a></li>
              @endif

          @endforeach
          
          @if(empty(Session::get('admin_code') || Session::get('mng_code') || Session::get('mngr_code')))
          <li data-toggle="modal" data-target="#leavemodal"><a href="#"><i class="icon-padnote"></i>Apply Leave</a></li>
          @endif
          {{-- @if(empty(Session::get('mng_code')) )
          <li data-toggle="modal" data-target="#leavemodal"><a href="#"><i class="icon-padnote"></i>Apply Leave</a></li>
          @endif --}}
         </ul>          
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Dashboard</h2>
          </div>
        </div>
        {{-- <!-- main content --> --}}

        @yield('content')

        {{--main content  --}}

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
               <p class="no-margin-bottom">2021-2022 &copy; Designed By <a target="_blank" href="https://www.thecodekart.com/">Codekart</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    {{-- leave modal --}}
    <div class="modal fade" id="leavemodal" tabindex="-1" role="dialog" aria-labelledby="leavemodalexmpl" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leavemodalexmpl">Leave Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="leave-emp-app">
              @csrf
              <div class="form-group">
                <label for="fromdate">Take Leave From</label>
                <input type="date" class="form-control" id="startDate" name="startDate" aria-describedby="date" placeholder="Enter date" required>
                <span id="datealert" class="text-warning"></span>
              </div>
              <div class="form-group">
                <label for="todate">To</label>
                <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Enter date" required>
                <span id="datealert1" class="text-warning"></span>
              </div>
              <div class="form-group">
                <textarea name="lvreason" class="form-control" id="lvreason" cols="40" rows="8" placeholder="Enter leave reason"></textarea>
                <span id="reasonalert" class="text-danger"></span>
              </div>
              <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="public/vendor/jquery/jquery.min.js"></script>
    <script src="public/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="public/chart/Chart.min.js"></script>
    <script src="public/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>    
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="public/js/front.js"></script>
    <!-- data tables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{-- <script src="public/plugins/datatables/jquery.dataTables.min.js"> </script>
    <script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"> </script>
    <script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"> </script> --}}
    <!--sweetalert-->
    <script src="public/sweet-alert/js/sweetalert2.min.js"> </script>
    <script src="resources/views/js/timer.js"></script>
    @stack('scripts')
    <script type="text/javascript">
      // function noBack()
      //  {
      //      window.history.forward()
      //  }
      // noBack();
      // // window.onload = noBack;
      // window.onpageshow = function(evt) { if (evt.persisted) noBack() }
      // window.onunload = function() { void (0) }
      function validateEmpLeave(){
        var start = document.getElementById('startDate').value;
        var end = document.getElementById('endDate').value;
        var currdate = new Date();

        if (new Date(start).getTime() <= currdate.getTime()) {
          document.getElementById('datealert').innerHTML="The Date must be Bigger or Equal to today date";
          return false;
         }
         
         if (new Date(end).getTime() <= currdate.getTime()) {
          document.getElementById('datealert1').innerHTML="The Date must be Bigger or Equal to today date";
          return false;
         }

        if(end < start){
         document.getElementById('datealert').innerHTML='Enter a valid date.. End date can not be less than apply date..';
          return false;
        }
        var reason = document.getElementById('lvreason').value;
        if(reason == ""){
          document.getElementById('reasonalert').innerHTML = 'Please Fill the reason..';
          return false;
        }
        if(reason.length < 10 ){
         document.getElementById('reasonalert').innerHTML = 'Please mention the proper reason within minimum 40 words';
          return false;
        }
        return true;
        // document.getElementById('leave-emp-app').reset();        
      }

      $(Document).ready(function(){

        $('#leave-emp-app').on('submit',function(e){
          var form = validateEmpLeave();
          alert(form);
          alert($(this).serialize());
          e.preventDefault();
          if(form){
            alert('reADY')

            $.ajax({
                type: 'POST',
                url:  'empLeaveApplication',
                data:$(this).serialize(),
                beforeSend:function(){
                  $('#submit').attr('disabled','disabled');
                  $('#submit').val('Requesting....');
                },
                success: function(response){
                  var result=response;
                  if(result.dbStatus == 'SUCCESS'){
                    $('#leave-emp-app')[0].reset();
                    alert('Request send successfully...');
                		$("#leavemodal").modal('hide');
                    document.getElementById('datealert1').innerHTML="";        
                    document.getElementById('datealert').innerHTML='';
                    document.getElementById('reasonalert').innerHTML = '';
                    $('#submit').attr('disabled',false);
                    $('#submit').val('Submit');
                  }
                  else if(result.dbStatus == "FAILURE"){
                    alert('failed to send request');
                  }                 
                },
                error:function(response) {
                  alert('Something went wrong....');
                }
                
              });

          }

        });
      });
  </script>
  </body>
</html>